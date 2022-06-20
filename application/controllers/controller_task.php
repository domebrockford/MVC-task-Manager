<?php
class Controller_Task extends Controller
{
	function __construct()
	{
		$this->model = new Model_Task();
		$this->view = new View();
	}
	function action_index()
	{
		if ($_SESSION['session'] and $_GET['task_id']) {
			# Проверка сессии и пермишенов
			$user = $_SESSION['user'];
			$userinfo = $this->model->get_user($user);
			if (is_array($userinfo)) {
				$args["loggined"] = true;
				if ($userinfo[0][4] == 1) {
					$admin = true;
					$args['permissions'] = array(
						"edit" 			=> true
					);
				} else {
					$admin = false;
					$args['permissions'] = array(
						"edit" 			=> false
					);
				}
			} else {
				session_unset();
				session_destroy();
				header("Location: /404");
			}
			# /Проверка сессии и пермишенов
			if ($admin) {
				$task_info = $this->model->get_full_task($_GET['task_id']);
				if (!empty($task_info)) {
					extract($task_info);
					/* 
					id => 1
					user_id => 1
					text => Установить и настроить модуль оплаты на сайте allmongolia.ru
					status => 1
					edited => 1
					login => admin
					email => admin@mail.ru
					*/
					$args = $task_info;
					$args['statuses'] = $this->model->get_task_statuses();
					$this->view->generate('task_template.php', 'base_template.php', $args);
				} else {
					header("Location: 404");
				}
			} else {
				header("Location: /404");
			}
		} else {
			header("Location: /404");
		}
	}
	function action_edit()
	{
		if ($_SESSION['session'] and isset($_POST['task_id']) and isset($_POST['text']) and isset($_POST['status'])) {
			# Проверка сессии и пермишенов
			$user = $_SESSION['user'];
			$userinfo = $this->model->get_user($user);
			if (is_array($userinfo)) {
				$args["loggined"] = true;
				if ($userinfo[0][4] == 1) {
					$admin = true;
				} else {
					$admin = false;
				}
			} else {
				session_unset();
				session_destroy();
				header("Location: /404");
			}
			# /Проверка сессии и пермишенов

			if ($admin){
				$task_id = $_POST['task_id'];
				$text = $_POST['text'];
				$status = $_POST['status'];
				if ($this->model->edit_task($task_id, $text, $status, $user) === TRUE) {
					header("Location: /task/success");
				} else {
					header("Location: /task/error");
				}
			}
			
		} else {
			header("Location: /404");
		}
	}
	function action_success()
	{
		$this->view->generate('task_success_template.php', 'base_template.php');
	}
	function action_error()
	{
		$this->view->generate('task_error_template.php', 'base_template.php');
	}
}
