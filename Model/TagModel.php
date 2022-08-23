<?php

namespace Model;

class TagModel extends BaseModel
{
    public static $instance;
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function __construct()
    {
        parent::__construct();
        $this->table = 'articles_tags';
        $this->pk = 'id_tag';
        $this->url = 'url_tag';
    }

    public function getAllTags(): array
    {
        $sql = "SELECT * FROM tags";
        return $this->db->query($sql);
    }

    public function addTag($id_article, $id_tag)
    {
        $sql = "INSERT INTO `articles_tags` (`id_article`, `id_tag`) VALUES ($id_article, $id_tag)";
        return $this->db->query($sql);
    }
    public function getTagById($id_article)
    {
        $sql = "SELECT * FROM `tags` JOIN articles_tags USING(id_tag) WHERE id_article=$id_article";
        return $this->db->query($sql);
    }
}
