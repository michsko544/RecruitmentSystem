<?php


class SignUpSystem
{
private $correct_data = true;

function __construct($flag_status)
{
    $this->correct_data = $flag_status;
}

function checkFlag()
{
    if ($this->correct_data == true) return true;
    else return false;
}

function notGood($err_name, $err_message)
{
    $this->correct_data = false;
    $_SESSION["$err_name"] = $err_message;
}

function rememberValue($value_name)
{
    if (isset($_SESSION["$value_name"]))
    {
        echo $_SESSION["$value_name"];
        unset($_SESSION["$value_name"]);
    }
}

function setError($error_name)
{
    if (isset($_SESSION["$error_name"]))
    {
        echo '<div class="error">'.$_SESSION["$error_name"].'</div>';
        unset($_SESSION["$error_name"]);
    }
}

// TODO add insert function
}

