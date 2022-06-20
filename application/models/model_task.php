<?php
require_once "db_connector.php";
class Model_Task extends Model
{
    function __construct()
    {
        $this->DBConnector = new DBConnector();
    }
    public function get_task_statuses()
    {
        $db_connect = $this->DBConnector->connect();
        $sql = "SELECT * FROM tm_task_statusnames";
        $result = mysqli_query($db_connect, $sql);
        if ($result == false) {
            echo mysqli_error($db_connect);
            mysqli_close($db_connect);
            return false;
        } else {
            $result = mysqli_fetch_all($result);
            mysqli_close($db_connect);
            return $result;
        }
    }
    public function get_user($login)
    {
        $db_connect = $this->DBConnector->connect();
        if ($login != NULL) {
            $sql = "SELECT * FROM tm_users WHERE login='" . $login . "' OR email='" . $login . "'";
        } else {
            $sql = "SELECT * FROM tm_users";
        }
        $result = mysqli_query($db_connect, $sql);
        if ($result == false) {
            echo mysqli_error($db_connect);
            mysqli_close($db_connect);
            return false;
        } else {
            $result = mysqli_fetch_all($result);
            mysqli_close($db_connect);
            return $result;
        }
    }
    public function get_full_task($task_id)
    {
        $db_connect = $this->DBConnector->connect();
        $sql = "SELECT
        tm_tasks.id,
        tm_tasks.text,
        tm_users.login,
        tm_users.email,
        tm_task_statusnames.name
    FROM
        tm_tasks
        JOIN tm_users ON tm_tasks.user_id = tm_users.id
        JOIN tm_task_statusnames ON tm_tasks.status = tm_task_statusnames.id
    WHERE
        tm_tasks.id =" . $task_id;
        $result = mysqli_query($db_connect, $sql);
        if ($result == false) {
            echo mysqli_error($db_connect);
            mysqli_close($db_connect);
            return false;
        } else {
            $result = mysqli_fetch_assoc($result);
            mysqli_close($db_connect);
            return $result;
        }
    }
    public function edit_task($task_id, $text, $status, $edited){
        $db_connect = $this->DBConnector->connect();
        $sql = "UPDATE tm_tasks
        SET text = '" . $text . "', status=" . $status . ", edited='" . $edited . "'
        WHERE id=" . $task_id . "";
        $result = mysqli_query($db_connect, $sql);
        if ($result == false) {
            echo mysqli_error($db_connect);
            mysqli_close($db_connect);
            return false;
        } else {
            mysqli_close($db_connect);
            return $result;
        }
    }
}
