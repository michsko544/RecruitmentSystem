<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/php/HandleJson.php");

class ManageUsers extends HandleJson {
    private $host;
    private $user;
    private $pass;
    private $name;
    private $conn = null;
    function __construct($host, $db_user, $db_pass, $db_name)
    {
        $this->host = $host;
        $this->user = $db_user;
        $this->pass = $db_pass;
        $this->name = $db_name;
        $this->conn = new mysqli($host, $db_user, $db_pass, $db_name);
    }

    function __destruct()
    {
        $this->conn->close();
    }

    function getUsers(){
        $query_id = "select id_user from users order by id_user";
        $query_lo = "select login from users order by id_user";
        $query_na = "select name from users order by id_user";
        $query_su = "select surname from users order by id_user";

        $array_id = array(); $array_lo = array();$array_na = array();$array_su = array();

        $json_array = array();

        mysqli_report(MYSQLI_REPORT_STRICT);
        try{
            $count = $this->fetchData($query_id, $array_id, $json_array['users']['idUser'], $this->host, $this->user, $this->pass, $this->name);
            $count = $this->fetchData($query_lo, $array_lo, $json_array['users']['login'], $this->host, $this->user, $this->pass, $this->name);
            $count = $this->fetchData($query_na, $array_na, $json_array['users']['name'], $this->host, $this->user, $this->pass, $this->name);
            $count = $this->fetchData($query_su, $array_su, $json_array['users']['surname'], $this->host, $this->user, $this->pass, $this->name);

            $this->addCounters($json_array['users']['counter'], $count);
            $this->createJsonFile('json/users_list.json', $json_array);
        }
        catch (Exception $e)
        {
            require_once ($_SERVER['DOCUMENT_ROOT'] . "/php/addError.php");
            addError($e);
            echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
        }
    }

    function blockUser($user){
        mysqli_report(MYSQLI_REPORT_STRICT);
        try {
            $select = $this->conn->query("select pass from  users where id_user = $user");
            $table = $select->fetch_assoc();
            $tmp_pass = "--blocked--" . $table['pass'];
            if (!($update = $this->conn->query("update users set pass = '{$tmp_pass}' where id_user = $user"))){
                throw new Exception($this->conn->error);
            } else {
                header("Location: /admin_manage_users.php?bU=success");
            }

        }
        catch (Exception $e)
        {
            require_once ($_SERVER['DOCUMENT_ROOT'] . "/php/addError.php");
            addError($e);
            echo "<div class='server-error'>Server error! Please try again later.</div>";
        }
    }

    function unblockUser($user){
        mysqli_report(MYSQLI_REPORT_STRICT);
        try{
            $select = $this->conn->query("select pass from  users where id_user = $user");
            $table = $select->fetch_assoc();
            $num = $select->num_rows;
            if ($num != 1)
            {
                throw new Exception($this->conn->error);
            } else {
                $tmp_pass = substr($table['pass'], 11);
                if (!($update = $this->conn->query("update users set pass = '{$tmp_pass}' where id_user = $user"))) {
                    throw new Exception($this->conn->error);
                } else {
                    header("Location: /admin_manage_users.php?bU=success");
                }
            }
        }
        catch (Exception $e)
        {
            require_once ($_SERVER['DOCUMENT_ROOT'] . "/php/addError.php");
            addError($e);
            echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
        }
    }

    function removeUser($user){
        mysqli_report(MYSQLI_REPORT_STRICT);
        try {
            if (!$this->conn->query("delete from users where id_user = $user")){
                throw new Exception($this->conn->error);
            } else {
                header("Location: /admin_manage_users.php?bU=success");
            }
        }
        catch (Exception $e)
        {
            require_once ($_SERVER['DOCUMENT_ROOT'] . "/php/addError.php");
            addError($e);
            echo "<div class='server-error'>Server error! Please try again later.</div>";
        }
    }
}
