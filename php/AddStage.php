<?php
require_once "HandleJson.php";
class AddStage extends HandleJson
{
    private $host;
    private $user;
    private $pass;
    private $name;
    private $correct_data = true;
    private $conn = null;
    function __construct($host, $db_user, $db_pass, $db_name)
    {
        $this->host = $host;
        $this->user = $db_user;
        $this->pass = $db_pass;
        $this->name = $db_name;
        mysqli_report(MYSQLI_REPORT_STRICT);
        try{
            $this->conn = new mysqli($host, $db_user, $db_pass, $db_name);
            if ($this->conn->connect_errno!=0){
                throw new Exception($this->conn->error);
            }
        } catch (Exception $e){
            require_once "addError.php";
            addError($e);
            echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
        }
    }

    function __destruct()
    {
        $this->conn->close();
    }

    function notGood($err_name, $err_message, $aid){
        $this->correct_data = false;
        $_SESSION["$err_name"] = $err_message;
        header("Location: /add-stage.php?aid=" . $aid);
    }

    function add($id_application, $name_p, $notes_p){
        $name_r = $name_p;
        $notes_r = $notes_p;
        $name = htmlspecialchars($name_r, ENT_QUOTES, "UTF-8");
        $notes = htmlspecialchars($notes_r, ENT_QUOTES, "UTF-8");
        if ((strlen($name) <= 1) || (strlen($name) > 40))
        {
            $this->notGood('err_position', 'Stage name must have more than 1 and less than 40 characters', $id_application);
        }
        if (strlen($notes) > 500)
        {
            $this->notGood('err_position', 'Notes must have less than 500 characters', $id_application);
        }
        if ($this->correct_data==true){
            mysqli_report(MYSQLI_REPORT_STRICT);
            try{
                if ($this->conn->query("insert into sor (id_stage, name_stage, description, id_application) values (null, '{$name}', '{$notes}', $id_application)")){
                    header("Location: /stages.php?aid=" . $id_application);
                } else {
                    throw new Exception($this->conn->error);
                }
            } catch (Exception $e)
            {
                require_once "addError.php";
                addError($e);
                echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
            }
        }
    }

    function view($id_application){
        $query_st = "select name_stage from sor s join applications ap on ap.id_application=s.id_application where s.id_application = {$id_application} order by s.id_stage";
        $query_de = "select description from sor s join applications ap on ap.id_application=s.id_application where s.id_application = {$id_application} order by s.id_stage";

        $data_push_st = array();
        $data_push_de = array();

        $json_array = array();

        mysqli_report(MYSQLI_REPORT_STRICT);
        try{
            $count_st = $this->fetchData($query_st, $data_push_st, $json_array['stages']['name'], $this->host, $this->user, $this->pass, $this->name);
            $count_de = $this->fetchData($query_de, $data_push_de, $json_array['stages']['description'], $this->host, $this->user, $this->pass, $this->name);

            $this->addCounters($json_array['counters']['stages'], $count_st);

            $this->createJsonFile('json/stage.json', $json_array);
        }
        catch (Exception $e)
        {
            require_once "addError.php";
            addError($e);
            echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
        }
    }
}


