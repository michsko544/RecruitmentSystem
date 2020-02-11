<?php
require "../connect.php";
require_once ($_SERVER['DOCUMENT_ROOT'] . "/php/admin/ManageUsers.php");

if (isset($_GET['uid'])) {
    try {
        $conn = new mysqli($host, $db_user, $db_pass, $db_name);
        if ($conn->connect_errno!=0){
            throw new Exception($conn->error);
        } else {
            $res = $conn->query("select pass from users where id_user = {$_GET['uid']}");
            $t_pass = $res->fetch_assoc();
            $pass_check = $t_pass['pass'];
            $tmp = substr($pass_check, 0, 11);
            $man = new ManageUsers($host, $db_user, $db_pass, $db_name);
            if ($tmp == '--blocked--'){
                $man->unblockUser($_GET['uid']);
            } else {
                $man->blockUser($_GET['uid']);
            }
        }
    } catch (Exception $e){
        require_once ($_SERVER['DOCUMENT_ROOT'] . "/php/addError.php");
        addError($e);
        echo "<div class='server-error'>Server error! Please try again later.</div>";
    }
}