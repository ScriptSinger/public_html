<?php

namespace Controllers;

use Core\Request;
use Model\SessionModel;
use Model\UserModel;
use Model\M_Valid;

class AuthController extends BaseController
{
    private $sessionModel;
    private $validator;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->sessionModel =  SessionModel::getInstance();
        $this->table = 'users';
    }

    private function loadValidation()
    {
        if ($this->validator == null)
            $this->validator = new M_Valid($this->table);
        return $this->validator;
    }

    public function loginAction()
    {
        $login = '';
        $password = '';
        $errors = [];
        // echo password_hash('', PASSWORD_BCRYPT);
        if ($this->request->isPost()) {
            $this->errors = [];  // обнуляем список ошибок
            $validator = $this->loadValidation(); // подгружаем модуль валидации
            $validator->execute($this->request->post);
            if ($validator->good()) {
                $fields = $validator->getObj();
                $login = $fields['login'];
                $password = $fields['password'];
                $remember = isset($_POST['remember']);
                $user = UserModel::getInstance()->getUserByLogin($login);
                if ($user == !null && password_verify($password, $user['password'])) {
                    $token = substr(bin2hex(random_bytes(128)), 0, 128);
                    $this->sessionModel->addSession($user['id_user'], $token);
                    $_SESSION['token'] = $token;
                    if ($remember) {
                        setcookie('token', $token, time() + 3600 * 24 * 30, BASE_URL);
                    }
                    header('Location: ' . BASE_URL . 'adm/articles');
                    exit();
                } else {
                    $user = null;
                }
            }
            $errors = $validator->errors();
        }
        $this->pageTitle = $title = "Вход";
        $this->pageContent = $this->tmpGenerate(
            'auth/v_login',
            [
                'login' => $login,
                'password' => $password,
                'errors' => $errors,
                'title' => $title
            ]
        );
    }

    public function logoutAction()
    {
        $user = UserController::getUserAuth();
        $this->sessionModel->delSession($user['id_user']);
        unset($_SESSION['token']);
        setcookie('token', '', time() - 1, BASE_URL);
        header('Location:' . BASE_URL);
        exit();
    }
}
