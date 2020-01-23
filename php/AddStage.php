<?php
require_once "HandleJson.php";
class AddStage extends HandleJson
{
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

    function add($id_application){

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
            echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
        }
    }
}
