<?php

namespace Controllers;

use Model\CategoryModel;
use Core\System;
use Core\Request;

class AdmCatController extends BaseController
{
    private $errors;
    public function __construct(Request $request)
    {
        $this->user = UserController::getInstance()->isAuth()->getUserAuth(); //проверка авторизации в случае успеха формируем массив $this->user
        $this->request = $request;
        $this->path = 'adm/articles';
        $this->pk = 'id_article';
    }

    public function allAction()
    {
        $cats = CategoryModel::getInstance()->getAll();
        $sidebar = $this->tmpGenerate('adm/v_sidebar', ['cats' => $cats]);
        $this->pageTitle = $title = 'Редактировать / Удалить категорию';
        $content = $this->tmpGenerate('cats/v_all', [
            'title' => $title,
            'cats' => $cats
        ]);
        $this->pageContent = $this->tmpGenerate(
            'base/v_con2col',
            [
                'sidebar' => $sidebar,
                'content' => $content
            ]
        );
    }

    public function addAction()
    {
        $this->pageTitle =  $title = 'Добавить категорию';
        $categoryModel = CategoryModel::getInstance();
        $cats = $categoryModel->getAll();
        $fields = [
            'title_cat' => '',
            'nav_cat' => '',
            'url_cat' => '',
            'description_cat' => '',
        ];
        if ($this->request->isPost()) {
            $post = $this->request->post;
            $post['url_cat'] = System::translit($post['title_cat']);
            if ($categoryModel->add($post)) {
                header('Location:' . BASE_URL . "adm/cats/all");
                exit();
            }
            $this->errors = $categoryModel->errors();
            $fields = $post; // соxранение полей при перезагрузке
        }
        $sidebar = $this->tmpGenerate('adm/v_sidebar', ['cats' => $cats]);
        $content = $this->tmpGenerate('cats/v_add', [
            'title' => $title,
            'fields' =>  $fields,
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
        $this->scripts[] = 'symbvol_counter';
        $this->pageTitle =  $title = 'Редактировать категорию';
        $categoryModel = CategoryModel::getInstance();
        $id  = (int)(URL_PARAMS['id']);
        $fields = $categoryModel->getOneById($id);
        if ($this->request->isPost()) {
            $post = $this->request->post;
            $post['url_cat'] = System::translit($post['title_cat']);
            if ($categoryModel->edit($id, $post)) {
                header('Location:' . BASE_URL . "adm/cats/all");
                exit();
            }
        }
        $cats = $categoryModel->getAll();
        $sidebar = $this->tmpGenerate('adm/v_sidebar', ['cats' => $cats]);
        $content = $this->tmpGenerate('cats/v_add', [
            'fields' =>  $fields,
            'title' => $title,
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
        $id = (int)(URL_PARAMS['id']);
        if ($this->request->isGet()) {
            CategoryModel::getInstance()->remove($id);
            header('Location:' . BASE_URL . "adm/cats/all");
            exit();
        }
    }
}
