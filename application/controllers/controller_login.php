<?php 
class Controller_Login extends Controller
{
	function __construct()
	{
		$this->model = new Model_Login();
		$this->view = new View();
	}
	function action_index(){
		if($_SESSION['session']){
			header('Location: /');
		}
		elseif(isset($_POST["login"]) and isset($_POST["password"])){
			$result = false;
			$login = $_POST["login"];
			$password = $_POST["password"];
			if($this->model->validate($login, $password)){
				$result = $this->model->get_user($login, $password);
				if($result[1] != NULL){
					$_SESSION['session'] = true;
					$_SESSION['user'] = $result[1];
					header("Location: /");
				} else{
					$this->view->generate('login_template.php', 'base_template.php');
				}
			}
			else{
				$this->view->generate('login_template.php', 'base_template.php');
			}
		}
		else{
		$this->view->generate('login_template.php', 'base_template.php');
		}
	}
}