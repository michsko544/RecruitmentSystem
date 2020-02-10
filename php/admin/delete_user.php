<?php
require_once "../connect.php";
require_once "ManageUsers.php";

try {
    if (isset($_GET['uid'])){
        $man = new ManageUsers($host, $db_user, $db_pass, $db_name);
        $man->removeUser($_GET['uid']);
    } else {
        throw new Exception("Cannot resolve _GET parameter");
    }
}catch (Exception $e){
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/php/addError.php");
    addError($e);
    echo "<div class='server-error'>Server error! Please try again later.</div>";
}
