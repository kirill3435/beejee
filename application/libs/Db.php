<?php

namespace application\libs;

use PDO;

class Db {

    public function __construct() {
        $config = require 'application/config/db.php';

        $this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['user'], $config['password']);
    }

    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql, $params);
		if (!empty($params)) {
			foreach ($params as $key => $val) {
				$stmt->bindValue(":".$key, $val);
			}
		}
		$stmt->execute($params);
		return $stmt;
    }

	public function row($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

    public function lastInsertId(){
		return $this->db->lastInsertId();
	}

    public function insert($table, $params = []) {
		$fieldstr = '';
		$valstr = '';

		foreach ($params as $key => $val) {
			$fieldstr .= '`' . $key . '`,';
			$valstr .= ':' . $key . ',';
		}
		$fieldstr = substr($fieldstr, 0, -1);
		$valstr = substr($valstr, 0, -1);

		$sql = 'INSERT INTO `' . $table . '` (' . $fieldstr . ') VALUES (' . $valstr . ')';
        $params;
		$this->query($sql, $params);
	}

	public function update($table, $params = []) { 
		$fieldstr = '';

		foreach ($params as $key => $val) {
			$fieldstr .= '`' . $key . '` = :' . $key . ',';
		}
		$fieldstr = substr($fieldstr, 0, -1);

		$sql = 'UPDATE `' . $table . '` SET' . $fieldstr . ' WHERE :id = id';
		$this->query($sql, $params);
	}

    public function count() {
        return $this->query('SELECT COUNT(*) as count FROM issues')->fetchColumn();
    }
}
?>