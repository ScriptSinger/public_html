<?php

namespace Controllers;

use Core\Request;
use Core\System;
use Model\M_Valid;

class SendController
{
    private $validator;
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->table = 'call_back'; //исключительно для валидатора
    }

    private function loadValidation()
    {
        if ($this->validator == null)
            $this->validator = new M_Valid($this->table);
        return $this->validator;
    }

    public function before()
    {
    }

    //сброс метода
    public function render()
    {
    }

    public function sendAction()
    {
        $post = $this->request->post;
        $ip= $this->request->getIp();
        $cityFull = System::getCity($ip);
        $errors = [];  // обнуляем список ошибок
        $validator = $this->loadValidation(); // подгружаем модуль валидации
        $validator->execute($post);
        if ($validator->good()) {
            $recaptchaResponse = $this->getCaptcha($post["g-recaptcha-response"]);
            if ($recaptchaResponse->success == true && $recaptchaResponse->score > 0.5) {
                $errors = [];
                $data = $validator->getObj();
                $message = [
                    'ip: ' => $ip,
                    'Город: ' => $cityFull['city']['name_ru'],
                    'Имя клиента: ' => $data['name'],
                    'Телефон: ' => "%2B" . $data['phone'],
                    'Неисправность: ' => $data['info'],
                  
                ];
                $txt = '';
                foreach ($message as $key => $value) {
                    $txt .= "<b>" . $key . "</b> " . $value . "%0A";
                }
                // file_put_contents('apps.txt', "$txt \n", FILE_APPEND);
                fopen("https://api.telegram.org/bot" . TELEGRAM_TOKEN . "/sendMessage?chat_id=" . TELEGRAM_CHAT_ID . "&parse_mode=html&text={$txt}", "r");
                // fopen открывает файл или url, mode: "r"- открывает файл только для чтения 
            } else {
                $errors = ($recaptchaResponse->success == true) ? [] : 'mrRobot';
            }
        } else {
            $errors =  $validator->errors();
        }
        $response = ['res' => empty($errors), 'errors' =>  $errors];
        echo json_encode($response);
    }

    private function  getCaptcha($p)
    {
        return  json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . SECRET_KEY . "&response={$p}"));
    }
}
