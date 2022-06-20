<?php
require_once "db_connector.php";
class Model_Tasks extends Model
{
    function __construct()
    {
        $this->DBConnector = new DBConnector();
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
    public function get_tasks($filters)
    {
        $db_connect = $this->DBConnector->connect();
        if ($filters == NULL) {
            $sql = "SELECT * FROM tm_tasks";
        } else {
            $sql = "SELECT * FROM tm_tasks";
            $where = " WHERE";
            $user_filter    = $filters['user_id'];
            $status_filter  = $filters['status'];
            $page_filter    = $filters['page'];
            $sortby         = $filters['sortby'];
            if ($user_filter) {
                $user_filter = ' user_id=' . $user_filter . ' AND';
            } else {
                $user_filter = "";
            }
            if ($status_filter != NULL) {
                $status_filter = ' tm_tasks.status=' . $status_filter;
            } else {
                $status_filter = " tm_tasks.status LIKE '%'";
            }
            if ($page_filter) {
                $page_filter = " LIMIT 3 OFFSET " . ($page_filter - 1) * 3;
            } else {
                $page_filter = " LIMIT 3 OFFSET 0";
            }
            if ($sortby == "1") {
                $sortby = " JOIN tm_users ON tm_tasks.user_id=tm_users.id" . $where . $user_filter . $status_filter . " ORDER BY login ASC";
            } elseif ($sortby == "2") {
                $sortby = " JOIN tm_users ON tm_tasks.user_id=tm_users.id" . $where . $user_filter . $status_filter . " ORDER BY login DESC";
            } elseif ($sortby == "3") {
                $sortby = " JOIN tm_users ON tm_tasks.user_id=tm_users.id" . $where . $user_filter . $status_filter . " ORDER BY email ASC";
            } elseif ($sortby == "4") {
                $sortby = " JOIN tm_users ON tm_tasks.user_id=tm_users.id" . $where . $user_filter . $status_filter . " ORDER BY email DESC";
            } else {
                $sortby = "";
            }
            if ($sortby != ""){
                $sql = $sql . $sortby . $page_filter;
            }
            else{
                $sql = $sql . $where . $user_filter . $status_filter . $sortby . $page_filter;
            }
            
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
    public function get_task_status()
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
    public function get_count_tasks($filters)
    {
        $db_connect = $this->DBConnector->connect();
        if ($filters == NULL) {
            $sql = "SELECT * FROM tm_tasks";
        } else {
            $sql = "SELECT * FROM tm_tasks WHERE";
            $user_filter    = $filters['user_id'];
            $status_filter  = $filters['status'];
            if ($user_filter) {
                $user_filter = ' user_id=' . $user_filter . ' AND';
            } else {
                $user_filter = "";
            }
            if ($status_filter != NULL) {
                $status_filter = ' status=' . $status_filter;
            } else {
                $status_filter = " status LIKE '%'";
            }
            $sql = $sql . $user_filter . $status_filter;
        }
        $result = mysqli_query($db_connect, $sql);
        if ($result == false) {
            echo mysqli_error($db_connect);
            mysqli_close($db_connect);
            return false;
        } else {
            $result = mysqli_num_rows($result);
            mysqli_close($db_connect);
            return $result;
        }
    }
}
