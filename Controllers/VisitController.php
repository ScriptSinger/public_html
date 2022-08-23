<?php

namespace Controllers;

use Core\Logger;
use Model\CategoryModel;

class VisitController extends BaseController
{
    private $logger;
    public function __construct()
    {
        UserController::getInstance()->isAuth();
        $this->logger  = Logger::getInstance();
    }

    public function allAction()
    {
        $visitsDays = $this->logger->getAllVisits();

        $this->pageTitle =  $title = 'Все логи';
        $cats = CategoryModel::getInstance()->getAll();
        $sidebar = $this->tmpGenerate('adm/v_sidebar', ['cats' => $cats]);
        $content = $this->tmpGenerate(
            'logs/v_visits_days',
            ['visitsDays' => $visitsDays]
        );

        $this->pageContent = $this->tmpGenerate(
            'base/v_con2col',
            [
                'title' => $title,
                'sidebar' => $sidebar,
                'content' => $content,
            ]
        );
    }

    public function oneAction()
    {
        $name = URL_PARAMS['dt'];
        $sidebar = null;
        $visits = $this->logger->getOneDay($name);
        $this->pageTitle = $title = 'Логи';
        $content = $this->tmpGenerate(
            'logs/v_visit',
            [
                'name' => $name,
                'visits' => $visits,
                'title' => $title
            ]
        );
        if ($this->logger->hasVisitsDay($name)) {
            $this->pageContent = $this->tmpGenerate(
                'base/v_con2col',
                [
                    'title' => $title,
                    'sidebar' => $sidebar,
                    'content' => $content
                ]
            );
        } else {
            $this->pageContent = $this->tmpGenerate('errors/v_404');
        }
    }
}
