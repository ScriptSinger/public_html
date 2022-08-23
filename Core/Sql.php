<?php

namespace Core;

class Sql
{
	private static $instance;
	private $db;
	public static function getInstance()
	{
		if (self::$instance == null) {
			self::$instance = new Sql();
		}
		return self::$instance;
	}

	private function __construct()
	{
		setlocale(LC_ALL, 'ru_RU.UTF8');
		$this->db = new \PDO(DBMS . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
		$this->db->exec('SET NAMES UTF8');
		$this->db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
	}

	public function query($sql, $object = [])
	{
		$q = $this->db->prepare($sql);
		$q->execute($object);
		if ($q->errorCode() != \PDO::ERR_NONE) {
			$info = $q->errorInfo();
			die($info[2]);
		}
		return $q->fetchAll();
	}

	public function getCount($sql, $object = [])
	{
		$query = $this->db->prepare($sql);
		$query->execute($object);
		if ($query->errorCode() != \PDO::ERR_NONE) {
			$info = $query->errorInfo();
			die($info[2]);
		}
		return (int)  $query->fetchColumn() ?? 0;
	}

	public function insert($table, $object)
	{
		$columns = [];

		foreach ($object as $key => $value) {

			$columns[] = $key;
			$masks[] = ":$key";

			if ($value === null) {
				$object[$key] = 'NULL';
			}
		}

		$columns_s = implode(',', $columns);
		$masks_s = implode(',', $masks);

		$sql = "INSERT INTO $table ($columns_s) VALUES ($masks_s)";

		$query = $this->db->prepare($sql);
		$query->execute($object);

		if ($query->errorCode() != \PDO::ERR_NONE) {
			$info = $query->errorInfo();
			die($info[2]);
		}

		return $this->db->lastInsertId();
	}

	public function update($table, $object, $where, $params = [])
	{
		$sets = [];
		foreach ($object as $key => $value) {
			$sets[] = "$key=:$key";
			if ($value === null) {
				$object[$key] = 'NULL';
			}
		}
		$sets_s = implode(',', $sets);
		$sql = "UPDATE $table SET $sets_s WHERE $where";


		$query = $this->db->prepare($sql);
		$query->execute(array_merge($object, $params));
		if ($query->errorCode() != \PDO::ERR_NONE) {
			$info = $query->errorInfo();
			die($info[2]);
		}
		return $query->rowCount();
	}

	public function delete(string $table, $where, array $params = [])
	{
		$sql = "DELETE FROM $table WHERE $where";
		$query = $this->db->prepare($sql);
		$query->execute($params);
		if ($query->errorCode() != \PDO::ERR_NONE) {
			$info = $query->errorInfo();
			die($info[2]);
		}
		return $query->rowCount();
	}
}
