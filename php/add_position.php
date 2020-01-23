<?php
require_once "php/FormsValidation.php";
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
        $this->conn = new mysqli($host, $db_user, $db_pass, $db_name);
    }

    function notGood($err_name, $err_message)
    {
        $this->setFlag(false);
        $_SESSION["$err_name"] = $err_message;
        header("Location: /manage_service.php");
        echo " ah shit ..";
    }

    function add(){
        if (isset($_POST['position'])){
            $position = $_POST['position'];
            $description = $_POST['description'];
            echo " we got far";
            if (!preg_match('/^[a-zA-Z0-9\040.\-:#@?,]+$/s', $position))
            {
                $this->notGood('err_position', 'Position may contain only letters and numbers');
            }
            if ((strlen($position) < 1) || (strlen($position) > 70))
            {
                $this->notGood('err_position', 'Position must have more than 1 and less than 70 characters');
            }

            if (!preg_match('/^[a-zA-Z0-9\040.\-:#@?,]+$/s', $description))
            {
                $this->notGood('err_description', 'Description may contain only letters and numbers');
            }
            if (strlen($description) > 500)
            {
                $this->notGood('err_description', 'Description must have less than 500 characters');
            }

            if ($this->checkFlag() == true){
                try {
                    echo " but our journey is not over";
                    if ($this->conn->connect_errno != 0) {
                        throw new Exception(mysqli_connect_errno());
                    } else {
                        echo " almost there";
                        if (!$this->conn->query("insert into positions (id_position, position, description) values (null, '{$position}', '{$description}')")){
                            echo " ahh man";
                            throw new Exception($this->conn->error);
                        } else {
                            echo " whats your problem";
                            $_SESSION['position-success'] = true;
                            header("Location: manage_service.php?aP=success");
                        }
                    }
                }
                catch (Exception $e){
                    echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
                }
            }
        }
    }
}


