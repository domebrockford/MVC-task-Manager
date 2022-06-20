<?php
require_once "db_connector.php";
class Model_Login extends Model
{
    function __construct()
    {
        $this->DBConnector = new DBConnector();
    }
	public function validate($login, $password)
    {
        return true;
    }
    public function get_user($login, $password){
        $db_connect = $this->DBConnector->connect();
        $sql = "SELECT * FROM tm_users WHERE login='" . $login . "' AND password='" . strval($password) . "'";
        $result = mysqli_query($db_connect, $sql);
        if ($result == false){
            echo mysqli_error($db_connect);
            mysqli_close($db_connect);
            return false;
        }
        else{
            $result = mysqli_fetch_row($result);
            mysqli_close($db_connect);
            return $result;
        }
    }
}
