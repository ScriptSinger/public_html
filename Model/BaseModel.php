<?php

namespace Model;

use Core\Sql;

abstract class BaseModel extends Sql
{
    protected $db;
    protected $table;
    protected $pk;
    protected $url;
    protected $url_art;

    public $errors;


    // список ошибок
    protected $validator;            // модуль валидации



    public function __construct()
    {
        $this->db = Sql::getInstance();
    }

    protected function loadValidation()
    {
        if ($this->validator == null)
            $this->validator = new M_Valid($this->table);
        return $this->validator;
    }

    public function errors()
    {
        return $this->errors;
    }

    // Получает все строки;
    public function getAll(): array
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->db->query($sql);
    }

    //Получает одну строку по URL
    public function getOnebyUrl(string $url = null): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->url}=:url";
        $array = ['url' => $url];
        $rowArray = $this->db->query($sql, $array);
        $row = ($rowArray  != null) ? $rowArray[0] : null;
        return $row;
    }

    // Получает одну строку по ID; 
    public function getOneById(int $id): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->pk}='$id'";
        $rowArray = $this->db->query($sql);
        $row = ($rowArray  != null) ? $rowArray[0] : null;
        return $row;
    }

    // Добавляет одну строку и возвращает ID последней вставленной строки или последовательное значение; 
    public function add(array $fields): int
    {
        $this->errors = [];  // обнуляем список ошибок
        $validator = $this->loadValidation(); // подгружаем модуль валидации
        $validator->execute($fields);
        if ($validator->good()) {

            return $this->db->insert($this->table, $validator->getObj());
        }
        $this->errors = $validator->errors();
        return false;
    }

    // Редактирует одну строку возвращает BOOL
    public function edit(int $id, array $fields): bool
    {
        $this->errors = [];  // обнуляем список ошибок
        $validator = $this->loadValidation(); // подгружаем модуль валидации
        $validator->execute($fields);
        if ($validator->good()) {
            $this->db->update($this->table, $validator->getObj(), "{$this->pk} = '$id'");
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

    // Удаляет одну строку возвращает BOOL
    public function remove(int $id): bool
    {
        $where = "{$this->pk}=:id";
        $this->db->delete($this->table, $where, ['id' => $id]);
        return true;
    }

   public function getValidation(array $fields)
    {
        $this->errors = [];  // обнуляем список ошибок
        $validator = $this->loadValidation(); // подгружаем модуль валидации
        $validator->execute($fields);
        if ($validator->good()) {

            return $validator->getObj();
        }
        $this->errors = $validator->errors();
        return false;
    }
}
