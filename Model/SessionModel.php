<?php

namespace Model;

class SessionModel extends BaseModel
{
    public static $instance;
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new SessionModel();
        }
        return self::$instance;
    }

    public function addSession(int $userId, string $token): bool
    {

        $sql = "INSERT INTO sessions(id_user, token ) VALUES(:uid, :token)";
        $params = [
            'uid' => $userId,
            'token' => $token
        ];
        $this->db->query($sql, $params);
        return true;
    }

    public function getSession(string $token): ?array
    {

        $sql = "SELECT * FROM sessions WHERE token=:token";
        $session = $this->db->query($sql, ['token' => $token]);
        return $session === false ? null : $session[0];
    }

    public function delSession(int $id): bool
    {
        $sql = "DELETE FROM sessions WHERE id_user=:id_user LIMIT 1";
        $this->db->query($sql, ['id_user' => $id]);
        return true;
    }
}
