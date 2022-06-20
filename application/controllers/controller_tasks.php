<?php
class Controller_Tasks extends Controller
{
	function __construct()
	{
		$this->model = new Model_Tasks();
		$this->view = new View();
	}
	function action_index()
	{
		if ($_SESSION['session']) {
			$user = $_SESSION['user'];
			$userinfo = $this->model->get_user($user);
			$statuses = $this->model->get_task_status();
			// Проверка сессии и пермишенов
			if (is_array($userinfo)) {
				$args["loggined"] = true;
				if ($userinfo[0][4] == 1) {
					$admin = true;
					$args['permissions'] = array(
						"user_filter" 	=> true,
						"status_filter" => true,
						"edit" 			=> true
					);
				} else {
					$admin = false;
					$args['permissions'] = array(
						"user_filter" 	=> false,
						"status_filter" => true,
						"edit" 			=> false
					);
				}
			} else {
				session_unset();
				session_destroy();
				header("Location: /login");
			}
			$user_filter 	= $_GET["user"];
			$status_filter 	= $_GET["status"];
			$sortby_filter	= $_GET["sortby"];
			$page_filter 	= $_GET['page'];

			# Обработка юзера
			if ($admin) {
				$user = $this->model->get_user($user_filter);
				if (count($user) == 1) {
					$filter["user_id"] = $user[0][0];
				}
			} else {
				$filter["user_id"] = $userinfo[0][0];
			}
			# /Обработка юзера

			# Обработка страниц
			if ($page_filter) {
				$filter["page"] = $page_filter;
			} else {
				$filter["page"] = 1;
			}
			# /Обработка страниц

			# Обработка статусов
			if ($status_filter != 0) {
				$filter['status'] = $status_filter;
			} else {
				$filter['status'] = NULL;
			}
			# /Обработка статусов
			
			# Обработка сортировки
			if ($sortby_filter != "0") {
				$filter['sortby'] = $_GET['sortby'];
			} else {
				$filter['sortby'] = "0";
			}
			# /Обработка сортировки
			$tasks = $this->model->get_tasks($filter);
			$tasks_count = $this->model->get_count_tasks($filter);
			$args["users"] 			= $this->model->get_user(NULL);
			$args["status_names"] 	= $statuses;
			$args["tasks"] 			= $tasks;
			$args["pages"] 			= $tasks_count;
			$args["filters"] 		= array(
				"user_filter"	=> $user_filter,
				"status_filter" => $status_filter
			);
		} else {
			$args = array("loggined" => false);
		}
		if (isset($tasks_count)) {
			if ($tasks_count % 3 != 0) {
				$pages = (intdiv($tasks_count, 3)) + 1;
			} else {
				$pages = intdiv($tasks_count, 3);
			}
			$args["pages"] = $pages;
		}
		$this->view->generate('tasks_template.php', 'base_template.php', $args);
	}
}
