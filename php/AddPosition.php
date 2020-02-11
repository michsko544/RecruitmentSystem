<?php
require_once "FormsValidation.php";
class AddPosition extends FormsValidation {
    private $host;
    private $user;
    private $pass;
    private $name;
    private $conn = null;

    function __construct($flag_status, $host, $db_user, $db_pass, $db_name)
    {
        parent::__construct($flag_status);
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

    function notGood($err_name, $err_message)
    {
        $this->setFlag(false);
        $_SESSION["$err_name"] = $err_message;
        header("Location: /applicationsW.php?er=". $err_name);
    }

    function add(){
        if (isset($_POST['position'])){
            $position_r = $_POST['position'];
            $description_r = $_POST['description'];
            $position = htmlspecialchars($position_r, ENT_QUOTES, "UTF-8");
            $description = htmlspecialchars($description_r, ENT_QUOTES, "UTF-8");

            if ((strlen($position) < 1) || (strlen($position) > 70))
            {
                $this->notGood('err_position', 'Position must have more than 1 and less than 70 characters');
            }

            if (strlen($description) > 500)
            {
                $this->notGood('err_description', 'Description must have less than 500 characters');
            }
            $_SESSION['rem_position'] = $position;
            $_SESSION['rem_description'] = $description;
            if ($this->checkFlag() == true){
                try {
                    if ($this->conn->connect_errno != 0) {
                        throw new Exception(mysqli_connect_errno());
                    } else {
                        if (!$this->conn->query("insert into positions (id_position, position, description) values (null, '{$position}', '{$description}')")){
                            throw new Exception($this->conn->error);
                        } else {
                            $_SESSION['position-success'] = true;
                            if (isset($_SESSION['rem_position'])) unset($_SESSION['rem_position']);
                            if (isset($_SESSION['rem_description'])) unset($_SESSION['rem_description']);
                            header("Location: ../applicationsW.php?aP=success");
                        }
                    }
                }
                catch (Exception $e){
                    require_once "addError.php";
                    addError($e);
                    echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
                }
            }
        }
    }
}

session_start();
if ((!isset($_SESSION['logged_in'])) || ($_SESSION['logged_in'] == false))
{
    header('Location: /index.php');
    exit();
}
require_once "connect.php";
$add_pos = new AddPosition(true, $host, $db_user, $db_pass, $db_name);
$add_pos->add();


