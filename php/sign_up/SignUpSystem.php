<?php


class SignUpSystem
{
public $correct_data = true;
public $_SESSION['insert_username'] = '';
public $_SESSION['insert_email'] = '';
public $_SESSION['insert_password'] = '';

function notGood($err_name, $err_message)
{
    $correct_data = false;
    $_SESSION["$err_name"] = $err_message;
}

function rememberValue ($value_name)
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

