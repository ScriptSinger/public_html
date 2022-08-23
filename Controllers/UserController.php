<?php

namespace Controllers;

use Model\UserModel;
use Model\SessionModel;

class UserController
{
    private static $instance;
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function getUserAuth(): ?array
    {
        $user = null;
        $token = $_SESSION['token'] ?? $_COOKIE['token'] ?? null;
        if ($token !== null) {
            $session = SessionModel::getInstance()->getSession($token);
            if ($session !== null) {
                $user = UserModel::getInstance()->getUserById($session['id_user']);
            }
            if ($user === null) {
                unset($_SESSION['token']);
                setcookie('token', '', time() - 1, BASE_URL);
            }
        }
        return $user;
    }

    public function isAuth()
    {
        if ($this->getUserAuth() === null) {
            header('Location:' . BASE_URL . 'auth/login');
            exit();
        } else {
            return $this;
        }
    }
}
