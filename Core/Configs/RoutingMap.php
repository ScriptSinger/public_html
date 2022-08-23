<?php
function a()
{
    $intGT0 = '[1-9]+\d*';
    $normUrl = '[0-9aA-zZ_-]+';
    $log = '\d{4}\-\d{2}\-\d{2}\.txt';
    return [
        [
            'pattern' => "/^adm\/articles$/",    //Статьи в админке
            'controller' => 'AdmArtController',
            'action' => 'allAction'
        ],

        [
            'pattern' => "/^adm\/articles\/($normUrl)\/?$/", //Статьи по категориям в админке
            'controller' => 'AdmArtController',
            'action' => 'allAction',
            'params' => [
                'url' => 1
            ]
        ],

        [
            'pattern' => "/^adm\/article\/($normUrl)\/($intGT0)\/?$/", //Одна статья в админке
            'controller' => 'AdmArtController',
            'action' => 'oneAction',
            'params' => [
                'url' => 1,
                'id' => 2
            ]
        ],

        [
            'pattern' => "/^adm\/article\/add\/?$/",
            'controller' => 'AdmArtController',
            'action' => 'addAction'
        ],

        [
            'pattern' => "/^adm\/article\/edit\/($normUrl)\/($intGT0)\/?$/",
            'controller' => 'AdmArtController',
            'action' => 'editAction',
            'params' => ['id' => 2]
        ],

        [
            'pattern' => "/^adm\/article\/uploader\/?$/",
            'controller' => 'CkController',
            'action' => 'uploadAction'
        ],

        [
            'pattern' => "/^adm\/article\/manager\/?$/",
            'controller' => 'CkController',
            'action' => 'managerAction'
        ],

        [
            'pattern' => "/^adm\/article\/delete\/($normUrl)\/($intGT0)\/?$/",
            'controller' => 'AdmArtController',
            'action' => 'deleteAction',
            'params' => ['id' => 2]
        ],

        [
            'pattern' => "/^adm\/cats\/all$/",
            'controller' => 'AdmCatController',
            'action' => 'allAction'

        ],

        [
            'pattern' => '/^adm\/cat\/add\/?$/',
            'controller' => 'AdmCatController',
            'action' => 'addAction'
        ],

        [
            'pattern' => "/^adm\/cat\/edit\/($intGT0)\/?$/",
            'controller' => 'AdmCatController',
            'action' => 'editAction',
            'params' => ['id' => 1]
        ],

        [
            'pattern' => "/^adm\/cat\/delete\/($intGT0)\/?$/",
            'controller' => 'AdmCatController',
            'action' => 'deleteAction',
            'params' => ['id' => 1]
        ],

        [
            'pattern' => '/^auth\/login\/?$/',
            'controller' => 'AuthController',
            'action' => 'loginAction'
        ],

        [
            'pattern' => '/^auth\/logout\/?$/',
            'controller' => 'AuthController',
            'action' => 'logoutAction'
        ],

        [
            'pattern' => '/^$/',
            'controller' => 'MainController',
            'action' => 'mainAction'
        ],

        [
            'pattern' => '/^default$/',
            'controller' => 'ErrorController',
            'action' => 'notFoundAction',
            'params' => []
        ],

        [
            'pattern' => '/^send\/?$/',
            'controller' => 'SendController',
            'action' => 'sendAction'
        ],

        [
            'pattern' => "/^articles\/?$/",
            'controller' => 'ArticlesController',
            'action' => 'allAction'
        ],

        [
            'pattern' => "/^articles\/($normUrl)\/?$/",
            'controller' => 'ArticlesController',
            'action' => 'allAction',
            'params' => ['url' => 1]
        ],

        [
            'pattern' => "/^article\/($normUrl)\/?$/",
            'controller' => 'ArticlesController',
            'action' => 'oneAction',
            'params' => ['url' => 1]
        ],

        [
            'pattern' => '/^logs$/',
            'controller' => 'VisitController',
            'action' => 'allAction',
        ],

        [
            'pattern' => "/^log\/($log)$/",
            'controller' => 'VisitController',
            'action' => 'oneAction',
            'params' => ['dt' => 1]
        ]
    ];
}
return a();
