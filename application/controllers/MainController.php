<?php

namespace application\controllers;

use application\core\Controller;
use application\libs\Db;
use application\core\View;

class MainController extends Controller {

    public function indexAction() {
        if (isset($_GET["PAGE"])) {
            $page = (int)htmlspecialchars($_GET["PAGE"]);
        } else {
            $page = 1;
        }
        
        $data['count'] = $this->model->getTasksCount();
        if (isset($_GET["SORT"])) {
            $orderBy = htmlspecialchars($_GET["SORT"]);
        } else {
            $orderBy = '';
        }

        $data['tasks'] = $this->model->pagination($page, $orderBy);
        $this->view->render('Главная', $data);
    }

    public function loginAction() {
		if (!empty($_POST)) {
			if (!$this->model->loginValidate($_POST)) {
				$this->view->message('Неверные данные', $this->model->error);
			}
			$_SESSION['admin'] =  true;
		}
	}

    public function logoutAction() {
		unset($_SESSION['admin']);
	}

    public function addTaskAction() {
        if (!empty($_POST)) {
            $id = $this->model->taskAdd($_POST);

            if (!$id) {
                $this->view->message('error', 'что-то пошло не так');
            }
            $this->view->message('success', 'Задача добавлена');
        }
        $this->view->render('Добавление задачи');
    }

    public function editTaskAction() {
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
            if (!empty($_POST)) {
                $id = $this->model->taskEdit($this->route['id'], $_POST);

                if (!$this->route['id']) {
                    $this->view->message('error', 'что-то пошло не так');
                }
                $this->view->message('success', 'Задача изменена');
            }
            $vars = $this->model->getTask($this->route['id']);
            if (empty($vars)) {
                $this->view->errorCode(404);
            }
            $this->view->render('Редактирование задачи', $vars);
        } else {
            View::errorCode(403);
        }
    }

    public function taskMarkedReadyAction() {
        if ($_SESSION['admin'] && $_SESSION['admin'] == true) {
            $_POST['ready'] = ($_POST['ready'] == 1) ? 0 : 1;

            $id = $this->model->taskReady($_POST);
        } else {
            View::errorCode(403);
        }
    }
}
?>