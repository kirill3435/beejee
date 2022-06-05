<?php

namespace application\models;

use application\core\Model;

class Main extends Model {

    public function loginValidate($post) {
		$config = require 'application/config/admin.php';
		if ($config['login'] != $post['login'] || !password_verify($post['password'], $config['password'])) {
			$this->error = 'error';
			return false;
		}
		return true;
	}

    public function pagination($page, $orderBy = '') {
        $notesCount = 3;
        $limit = '';
        $start = $page * $notesCount - $notesCount;
        $limit = ' LIMIT ' . $start . ', ' . $notesCount;
        if ($orderBy != '') {
            $order = ' ORDER BY ' . $orderBy;
        } else {
            $order = '';
        }
        $data = $this->db->row('SELECT * FROM issues' . $order . $limit);

        return $data;
    }

    public function getTask($id, $arSelect = array('*')) {
        $strSelect = implode(", ", $arSelect);
        $params = [
            'id' => $id,
        ];
        return $this->db->row('SELECT ' . $strSelect . ' FROM issues WHERE id = :id', $params);
    }

    public function taskAdd($post) {
        $params = [
            'id' => '',
        ];
        foreach ($post as $key => $val) {
            $params[$key] = htmlspecialchars($val);
        }
        $this->db->insert('issues', $params);
        return $this->db->lastInsertId();
    }

    public function taskReady($post) {
        foreach ($post as $key => $val) {
            $params[$key] = htmlspecialchars($val);
        }
        return $this->db->update("issues", $params);
    }

    public function taskEdit($id, $post) {
        $params = [
            'id' => $id,
        ];

        foreach ($post as $key => $val) {
            $params[$key] = htmlspecialchars($val);
        }
        return $this->db->update("issues", $params);
    }

    public function getTasksCount() {
        return $this->db->count();
    }
}
?>