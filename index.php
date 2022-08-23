<?php
spl_autoload_register(function ($name) {
    include_once __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $name) . '.php';
});
session_start();
include_once('init.php');


$app = new Core\App(new Core\Request($_GET, $_POST, $_SERVER));
$app->go();
