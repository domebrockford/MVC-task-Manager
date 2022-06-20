<?php
class Controller_Main extends Controller
{
	function action_index(){
		$this->view->generate('index_template.php', 'base_template.php');
	}
}