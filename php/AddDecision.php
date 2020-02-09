<?php
class AddDecision
{
    private $host;
    private $user;
    private $pass;
    private $name;
    private $conn = null;

    function __construct($host, $db_user, $db_pass, $db_name) {
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

    function __destruct() {
        $this->conn->close();
    }

    function update($id_application, $decision){
        try {
            if ($this->conn->connect_errno != 0) {
                throw new Exception(mysqli_connect_errno());
            } else {
                if($this->conn->query("update applications set id_decision = $decision where id_application = $id_application"))
                    header("Location: ../applicationsW.php?role=recruiter&aD=success");
                else
                    throw new Exception($this->conn->error);
            }
        } catch (Exception $e){
            require_once "addError.php";
            addError($e);
            echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
        }
    }
}

session_start();
if ((!isset($_SESSION['logged_in'])) || ($_SESSION['logged_in'] == false))
{
    header('Location: /index.php');
    exit();
}

require "connect.php";
if (isset($_GET['aid'])){
    if (isset($_POST['name-decision'])){
        $decision = new AddDecision($host, $db_user, $db_pass, $db_name);
        $aid = $_GET['aid'];
        $dec = $_POST['name-decision'];
        switch ($dec){
            case "Rejected":
                $decision->update($aid, 1);
                break;
            case "Accepted":
                $decision->update($aid, 2);
                break;
            case "Noteworthy":
                $decision->update($aid, 3);
                break;
        }

    }
}
