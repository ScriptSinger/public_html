<?php

namespace Controllers;

class CkController extends BaseController
{
    public function __construct()
    {
        UserController::getInstance()->isAuth();
        $this->uploadDir = 'assets/img/ck/';
    }

    public function before()
    {
    }

    public function render()
    {
    }

    public function uploadAction()
    {
        $callback = 1;  //Ответ JSON: 1 -файл загружен успешно, 0 - файл не может быть загружен  
        $file_name = $_FILES['upload']['name'];
        $getMime = explode('.', $file_name);
        $mime = end($getMime);
        $types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
        if (!in_array($mime, $types)) {
            $error = "Go Home";
            $http_path = '';
        } else {
            $file_name = substr_replace(sha1(microtime(true)), '', 12) . '.' . $mime;
            $file_name_tmp = $_FILES['upload']['tmp_name'];
            $file_new_name = CKUPLOAD_DIR; //   assets/img/ck/
            $full_path = $file_new_name . $file_name;
            if (copy($file_name_tmp, $full_path)) {
                $http_path = $full_path;
                $error = '';
            } else {
                $error = "Произошла ошибка, попробуйте еще раз";
                $http_path = '';
            }
        }
        echo "<script>window.parent.CKEDITOR.tools.callFunction($callback, \"" . BASE_URL . $http_path . "\",\"" . $error . "\");</script>";
    }

    public function managerAction()
    {
        // echo "<script>window.opener.CKEDITOR.tools.callFunction(CKEditorFuncNum, 'img_url'); </script>";
        $callback = (int)$_GET['CKEditorFuncNum'];
        $files = glob(CKUPLOAD_DIR . '*.{jpg,png,gif,bmp,jpeg}', GLOB_BRACE); //GLOB_BRACE - Раскрывает {jpg, png, gif, bmp, jpeg} для совпадения с 'jpg', 'png', 'gif, bmp, jpeg'.
        if (count($files) > 0) {
            foreach ($files as $file) {
                $file = BASE_URL . $file;
                echo '<button onclick="select(this)" data-name=' . $file . '> ' .  '<img width="200" height="200" src=' . $file . ' alt=' . basename($file) . ' />' . ' </button>';
            }
        }
        echo "<script>
        function select(el){window.opener.CKEDITOR.tools.callFunction( $callback , el.getAttribute('data-name'));
           window.close();}
            </script>";
    }
}
