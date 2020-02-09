<?php
require "php/connect.php";
require_once "manage_users.php";

if ($_SESSION['id_role'] != 1) {
    header("Location: /index.php");
    exit();
}

if ((isset($_GET['id_user'])) and (isset($_GET['action']))){
    $man = new ManageUsers($host, $db_user, $db_pass, $db_name);
    switch ($_GET['action']){
        case 'block':
            $man->blockUser($_GET['id_user']);
            break;
        case 'unblock':
            $man->unblockUser($_GET['id_user']);
            break;
        case 'remove':
            $man->removeUser($_GET['id_user']);
            break;
    }
}