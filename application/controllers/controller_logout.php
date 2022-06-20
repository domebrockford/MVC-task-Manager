<?php
class Controller_Logout extends Controller
{
	function action_index(){
        session_unset();
        session_destroy();
		header("Location: /");
	}
}