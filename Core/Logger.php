<?php

namespace Core;

class Logger
{

    public static $instance;
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function isValidUrl(string $url): bool
    {
        return !!preg_match('/^[aA-zZ0-9-_\/\?\.=&]*$/', $url);
    }

    public  function addVisitLog($ip, $cityFull)
    {
        $visitName = date('Y-m-d');
        $city= $cityFull['city']['name_ru'];
        
        $info = [
            'dt' => date('H-i-s'),
            'ip' => $ip,
            'city'=>$city,
            'uri' => $_SERVER['REQUEST_URI'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'referer' => $_SERVER['HTTP_REFERER'] ?? '',
        ];

        $info['isDanger'] = !($this->isValidUrl($_SERVER['REQUEST_URI']));
        $log = json_encode($info) . "\n";
        file_put_contents("db/visits/$visitName.txt", $log, FILE_APPEND);
        return $this;
    }

    private function checkVisitName(string $name): bool
    {
        return !!preg_match('/^\d{4}\-\d{2}\-\d{2}\.txt$/', $name);
    }

    public function getAllVisits(): array
    {
        $visits = [];
        $files = scandir("db/visits");
        foreach ($files as $file) {
            if (is_file("db/visits/$file") && $this->checkVisitName($file)) {
                $visits[] = $file;
            }
        }
        return $visits;
    }


    // Получить каждый визит
    public function getOneDay(string $date): array
    {
        $res = [];
        $lines = file("db/visits/$date");
        foreach ($lines as $line) {
            $res[] = json_decode(rtrim($line), true);
            // $res['is_Danger'] = !isValidUrl($res['uri']);
        }
        return $res;
    }



    public function hasVisitsDay(string $dt): bool
    {
        return $this->checkVisitName($dt) && file_exists("db/visits/$dt");
    }
    
     public function checkIpByBlacklist($ip, $blackList)
    {
        if (is_array($blackList)) {
            if (in_array($ip, $blackList)) {
                die('The Matrix has you...');
            }
        }
        return $this;
    }
}
