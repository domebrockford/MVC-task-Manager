<?php

class DBConnector
{
    public function connect()
    {
        $server = "localhost";
        $db_name = "";
        $db_username = "";
        $db_password = "";
        $res = mysqli_connect($server, $db_username, $db_password, $db_name);
        if ($res == false){
            echo mysqli_connect_error();
        }
        else{
            return $res;
        }
    }
}

