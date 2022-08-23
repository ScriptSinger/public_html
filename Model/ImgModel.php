<?php

namespace Model;

use model\BaseModel;


class ImgModel extends BaseModel
{



    private static $instance;
    public static function getInstance()
    {
        if (self::$instance == null)
            self::$instance = new self();
        return self::$instance;
    }

    public function __construct()
    {
        $this->table = 'articles';
        $this->pk = 'id_article';

        // parent::__construct('images', 'id_image');
    }

    public function simple_upload($file)
    {
        if (!$this->check_type($file['name'])) {
            $this->errors[] = 'INCORRECT_FILE_TYPE';
            return false;
        }
        $name = M_Helpers::unique_name(BIG_IMG_DIR, $file['name']);
        if ($name  && copy($file['tmp_name'], BIG_IMG_DIR . $name))
            $this->resize(BIG_IMG_DIR . $name, SMALL_IMG_DIR . $name, 320, 240);

        return $name;
    }

    private function check_type($name)
    {
        $getMime = explode('.', $name);
        $mime = strtolower(end($getMime));
        $types = ['jpg', 'png', 'gif', 'bmp', 'jpeg'];
        return in_array($mime, $types);
    }

    //функция не работает без GD библиотеки
    private function resize($src, $dest, $width, $height = null, $rgb = 0xFFFFFF, $quality = 100)
    {
        if (!file_exists($src)) return false;

        $size = getimagesize($src);

        if ($size === false) return false;

        // Определяем исходный формат по MIME-информации, предоставленной
        // функцией getimagesize, и выбираем соответствующую формату
        // imagecreatefrom-функцию.
        $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
        $icfunc = "imagecreatefrom" . $format;
        if (!function_exists($icfunc)) return false;

        $x_ratio = $width / $size[0];

        if ($height === null)
            $height = $size[1] * $x_ratio;

        $y_ratio = $height / $size[1];

        $ratio       = min($x_ratio, $y_ratio);
        $use_x_ratio = ($x_ratio == $ratio);

        $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
        $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
        $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width) / 2);
        $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);

        $isrc = $icfunc($src);
        $idest = imagecreatetruecolor($width, $height);
        imagefill($idest, 0, 0, $rgb);
        imagecopyresampled(
            $idest,
            $isrc,
            $new_left,
            $new_top,
            0,
            0,
            $new_width,
            $new_height,
            $size[0],
            $size[1]
        );
        imagejpeg($idest, $dest, $quality);
        imagedestroy($isrc);
        imagedestroy($idest);
        return true;
    }



    // public function upload_base64($name, $value)
    // {
    //     if (!$this->check_type($name))
    //         return false;

    //     $getMime = explode('.', $name);
    //     $mime = strtolower(end($getMime));
    //     $filename = mt_rand(0, 10000000) . '.' . $mime;

    //     while (file_exists(THUMB_BIG_DIR . $filename))
    //         $filename = mt_rand(0, 10000000) . '.' . $mime;

    //     $id = $this->db->Insert('images', array('path' => $filename));
    //     $this->move_upload_base64($value, $filename);
    //     return $id;
    // }


    // public function editImg($id_image, $fields)
    // {
    //     $id_image = (int)$id_image;

    //     $where = "id_image = '$id_image'";
    //     $this->db->Update('images', $fields, $where);

    //     return true;
    // }

    public function deleteImg($filename)
    {


        if (file_exists(BIG_IMG_DIR  . $filename))
            unlink(BIG_IMG_DIR  . $filename);

        if (file_exists(SMALL_IMG_DIR . $filename))
            unlink(SMALL_IMG_DIR . $filename);

        return true;
    }

    // private function move_upload_base64($file, $name)
    // {
    //     // ������� ������
    //     $data = explode(',', $file);

    //     // ���������� ������, �������������� ���������� MIME base64
    //     $encodedData = str_replace(' ', '+', $data[1]);
    //     $decodedData = base64_decode($encodedData);

    //     // ������� ����������� �� �������
    //     if (file_put_contents(THUMB_BIG_DIR . $name, $decodedData)) {
    //         $this->resize(THUMB_BIG_DIR . $name, THUMB_SMALL_DIR . $name, 320, 240);
    //         return true;
    //     }

    //     return false;
    // }
}
