<?php

namespace Controllers;

use Model\ArticleModel;
use Model\CategoryModel;
use Core\Request;
use Core\System;
use Model\TagModel;

class AdmArtController extends BaseController
{
    private $errors;

    public function __construct(Request $request)
    {
        $this->path = 'adm/articles'; // путь для функции пагинации
        $this->pk = 'id_article';
        $this->categoryModel = CategoryModel::getInstance();
        $this->articleModel = ArticleModel::getInstance();
        $this->request = $request;
        $this->user = UserController::getInstance()->isAuth()->getUserAuth(); //проверка авторизации в случае успеха формируем массив $this->user
    }

    public function allAction()
    {
        $this->scripts[] = 'popup';
        $get = $this->request->get;
        $url = isset(URL_PARAMS['url']) ? URL_PARAMS['url'] : null;
        $page = (int)isset($get['page']) ? $get['page'] : 1; //получаем текущий номер страницы (по умолчанию номер страницы равен 1)

        $articles = $this->articleModel->getArticles($page, $url);
        $pagination = $this->getPagination($page, $url);
        if ($articles == null) {
            var_dump('hi');
            die;
            $articles = $this->articleModel->getArticlesByTag($page, $url);
        }

        foreach ($articles as $name => $article) {
            $articles[$name]['intro'] = $this->previewText($article['content'], 0, 200);
        }
        $cats = $this->categoryModel->getAll();
        $category = $this->categoryModel->getOnebyUrl($url);
        // if ($this->checkHasEntity($category)) {
        $this->pageTitle = $title = ($url !== null) ? $category['title_cat'] : 'Статьи';
        $this->description = ($url !== null) ? $category['description_cat'] : 'Ремонт холодильников и стиральных машин с выездом на дом.';
        $navbar = $this->tmpGenerate('v_navbar', $pagination);
        $sidebar = $this->tmpGenerate('adm/v_sidebar', ['cats' => $cats]);
        $content = $this->tmpGenerate('adm/v_articles', [
            'title' => $title,
            'articles' => $articles,
            'navbar' => $navbar
        ]);
        $this->pageContent = $this->tmpGenerate(
            'base/v_con2col',
            [
                'sidebar' => $sidebar,
                'content' => $content
            ]
        );
        // } else {
        //     $this->generateError(404);
        // }
    }


    public function oneAction()
    {
        $this->scripts[] = 'popup';
        $this->scripts[] = 'scroll';
        $url = URL_PARAMS['url'];
        $article = $this->articleModel->oneArticle($url);
        if ($this->checkHasEntity($article)) {
            $cats = $this->categoryModel->getAll();
            $tags = TagModel::getInstance()->getTagById($article['id_article']);
            $sidebar = $this->tmpGenerate('adm/v_sidebar', ['cats' => $cats]);
            $content = $this->tmpGenerate('adm/v_article', [
                'article' => $article,
                'tags' => $tags,
                'cats' => $cats,
            ]);
            $this->pageTitle =  $article['title'];
            $this->description = $article['description'];
            $this->pageContent = $this->tmpGenerate(
                'base/v_con2col',
                [
                    'sidebar' => $sidebar,
                    'content' => $content
                ]
            );
        } else {
            $this->generateError(404);
        }
    }

    public function addAction()
    {
        $this->scripts[] = 'ckeditor/ckeditor';
        $this->scripts[] = 'ck_init';
        $this->scripts[] = 'symbvol_counter';
        $this->pageTitle = $title = 'Добавить статью';
        $fields = [
            'url_art' => '',
            'title' => '',
            'words' => '',
            'description' => '',
            'content' => '',
            'alt' => ''
        ];
        $cats = $this->categoryModel->getAll();
        $articleModel = ArticleModel::getInstance();
        if ($this->request->isPost()) {
            $url = System::translit($this->request->post['title']); //функция преобразования названия статьи в Человеко-понятный Url
            if ($id = $articleModel->addArticle(array_merge(
                $_POST,
                $_FILES,
                [
                    'id_user' => $this->user['id_user'],
                    'id_cat' => $this->request->post['id_cat'],
                    'url_art' => $url
                ]
            ))) {
                header('Location:' . BASE_URL . "adm/article/$url/$id");
                exit();
            }
            $this->errors = $articleModel->errors();
            $fields = $_POST; // соxранение полей при перезагрузке
        }

        $sidebar = $this->tmpGenerate('adm/v_sidebar', ['cats' => $cats]);
        $content = $this->tmpGenerate('adm/v_add', [
            'title' => $title,
            'cats' => $cats,
            'fields' => $fields,
            'errors' => $this->errors,

        ]);
        $this->pageContent = $this->tmpGenerate(
            'base/v_con2col',
            [
                'sidebar' => $sidebar,
                'content' => $content
            ]
        );
    }

    public function editAction()
    {
        $this->scripts[] = 'ckeditor/ckeditor';
        $this->scripts[] = 'ck_init';
        $this->scripts[] = 'symbvol_counter';
        $this->pageTitle = $title = 'Редактировать статью';
        $id = (int) URL_PARAMS['id'];
        $articleModel = ArticleModel::getInstance();
        $fields = $articleModel->oneArticleById($id);
        $cats = $this->categoryModel->getAll();
        if ($this->request->isPost()) {
            $url = System::translit($this->request->post['title']); //функция преобразования названия статьи в Человеко-понятный Url
            if ($id = $articleModel->editArticle($id, array_merge(
                $_POST,
                $_FILES,
                [
                    'id_user' => $this->user['id_user'],
                    'id_cat' => $this->request->post['id_cat'],
                    'url_art' => $url
                ]
            ))) {
                header('Location:' . BASE_URL . "adm/article/$url/$id");
                exit();
            }
            $this->errors = $articleModel->errors();
        }
        $sidebar = $this->tmpGenerate('adm/v_sidebar', ['cats' => $cats]);
        $content = $this->tmpGenerate('adm/v_edit', [
            'title' => $title,
            'cats' => $cats,
            'fields' => $fields,
            'errors' => $this->errors,
        ]);
        $this->pageContent = $this->tmpGenerate(
            'base/v_con2col',
            [
                'sidebar' => $sidebar,
                'content' => $content
            ]
        );
    }

    public function deleteAction()
    {
        if ($this->request->isGet()) {
            $id = (int)(URL_PARAMS['id']);
            $this->articleModel->deleteArticle($id);
            header('location:' . BASE_URL . 'adm/articles');
        }
    }


    // function checkId(string $strId): bool
    // {
    //     return preg_match('/^[1-9]+\d*$/', $strId);
    //     return preg_match('/^[1-9]+\d*/', $strId);
    // }
}
