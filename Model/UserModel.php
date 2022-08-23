<?php

namespace Model;

class UserModel extends BaseModel
{
    public static $instance;
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new UserModel();
        }
        return self::$instance;
    }

    public function getUserByLogin(string $login): ?array
    {

        $sql = "SELECT id_user, password FROM users
        WHERE login=:login";

        $user = $this->db->query($sql, ['login' => $login]);

        return $user === false ? null : $user[0];
    }

    public function getUserById(string $id): ?array
    {
        $sql = "SELECT id_user, login, name FROM users
        WHERE id_user=:id";
        $user = $this->db->query($sql, ['id' => $id]);
        return $user === false ? null : $user[0];
    }
}
