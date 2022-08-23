<?php

namespace Model;

use Model\ImgModel;

class ArticleModel extends BaseModel
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
        $this->table = 'articles';
        $this->pk = 'id_article';
        $this->url = 'url_art';
    }

    public function getArticles($page, $category = null): array
    {
        $array = [];
        $page = (int)$page;
        $shift = ($page - 1) * ARTICLES_LIMIT;

        $sql = "SELECT
        articles.*, 
        users.login,
        users.name, 
        cats.*
        FROM {$this->table}
        JOIN users USING(id_user)
        JOIN cats USING(id_cat)
        
            WHERE articles.status=1 AND url_cat=:url 
            ORDER BY dt_add 
            DESC   
            LIMIT $shift," . ARTICLES_LIMIT;
        $array = ['url' => $category];

        // $shift это количество строк, которые нужно пропустить
        // ARTICLES_LIMIT количество извлекаемых строк.
        return $this->db->query($sql, $array);
    }

    public function getArticlesByTag($page, $category = null): array
    {
        $array = [];
        $page = (int)$page;
        $shift = ($page - 1) * ARTICLES_LIMIT;

        $sql = "SELECT
        articles.*, 
        users.login,
        users.name, 
        cats.*,
        articles_tags.*, 
        tags.title  AS tag_title,
        tags.url AS url_tag 
        FROM {$this->table}
        JOIN users USING(id_user)
        JOIN cats USING(id_cat)
        JOIN articles_tags USING(id_article)
        JOIN tags USING(id_tag)
            WHERE articles.status=1 AND url=:url
            ORDER BY dt_add 
            DESC   
            LIMIT $shift," . ARTICLES_LIMIT;
        $array = ['url' => $category];

        // $shift это количество строк, которые нужно пропустить
        // ARTICLES_LIMIT количество извлекаемых строк.
        return $this->db->query($sql, $array);
    }

    public function oneArticle(string $url): ?array
    {
        $sql = "SELECT articles.*, users.login, users.name, cats.title_cat, url_cat, nav_cat FROM {$this->table}
        JOIN users USING(id_user)
        JOIN cats USING(id_cat)
        WHERE articles.status=1 AND {$this->url}=:url_art";
        $articleArray = $this->db->query($sql, [
            'url_art' => $url
        ]);
        $article = ($articleArray != null) ? $articleArray[0] : null;
        return $article;
    }

    public function oneArticleById(int $id): ?array
    {
        $sql = "SELECT articles.*, users.login, users.name, cats.title_cat, url_cat, nav_cat FROM {$this->table}
        JOIN users USING(id_user)
        JOIN cats USING(id_cat)
        WHERE articles.status=1 AND {$this->pk}=:id";
        $articleArray = $this->db->query(
            $sql,
            ['id' => $id]
        );
        $article = ($articleArray != null) ? $articleArray[0] : null;
        return $article;
    }


    public function addArticle(array $fields): int
    {
        $imgModel = ImgModel::getInstance();
        $imgName =  $imgModel->simple_upload($fields['file']);
        if (!$imgName) {
            $this->errors = $imgModel->errors();
            return false;
        }
        $fields['img'] = $imgName;
        return $this->add($fields);
    }

    public function editArticle(int $id, array $fields): int
    {
        $article = $this->getOneById($id);
        $imgModel = ImgModel::getInstance();
        if ($fields['file']['name'] !== '') {
            $imgName =  $imgModel->simple_upload($fields['file']);
            if (!$imgName) {
                $this->errors =  $imgModel->errors();
                return false;
            }
            $imgModel->deleteImg($article['img']); //удаляем файлы из директории;
            $fields['img'] = $imgName; //записываем в базу данных новое имя файла
        } else { //если файл не выбран
            unset($fields['file']); //удаляем из входящего массива поле с именем файла. Имя файла в базе данных остается прежним
        }
        return $this->edit($id, $fields);
    }

    public function deleteArticle(int $id): bool
    {
        $article = $this->getOneById($id);
        ImgModel::getInstance()->deleteImg($article['img']);
        return $this->remove($id);
    }

    // Получает количество всех строк
    public function countLines($cat = null): int
    {
        $array = [];
        if ($cat !== null) {
            $sql = "SELECT COUNT(*) AS total FROM {$this->table} 
            JOIN cats USING(id_cat)
         
            WHERE articles.status=1 AND url_cat=:url";
            $array = ['url' => $cat];
        } else {
            $sql = "SELECT COUNT(*) AS total FROM {$this->table}";
        }
        return $this->db->getCount($sql, $array);
    }
}
