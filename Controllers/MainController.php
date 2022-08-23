<?php

namespace Controllers;

use Model\CategoryModel;
use Core\Request;

class MainController extends BaseController
{
    protected $errors;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function mainAction()
    {
        $this->scripts[] = "jquery-3.6.0.min";
        $this->scripts[] = "send";
        $this->scripts[] = "jquery.maskedinput.min";
        $this->scripts[] = "phone_mask";
        $this->apiScripts[] = 'https://www.google.com/recaptcha/api.js';
        $this->pageTitle = $title = 'Ремонтная мастерская «УФА-МАСТЕР»';
        $this->description = '&#129520; Ремонт холодильников и стиральных машин в Уфе с выездом на дом';
        $cats = CategoryModel::getInstance()->getAll();
        $sidebar = $this->tmpGenerate('main/v_sidebar', [
            'cats' => $cats,
        ]);

        $content = $this->tmpGenerate('main/v_main', [
            'title' => $title,

        ]);
        $this->pageContent = $this->tmpGenerate(
            'base/v_con2col',
            [
                'sidebar' => $sidebar,
                'content' => $content
            ]
        );
    }
}
