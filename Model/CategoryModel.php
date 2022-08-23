<?php

namespace Model;

class CategoryModel extends BaseModel
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
        $this->table = 'cats';
        $this->pk = 'id_cat';
        $this->url = 'url_cat';
    }
}
