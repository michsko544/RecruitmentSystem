<?php
session_start();
if ((!isset($_SESSION['logged_in'])) || ($_SESSION['logged_in'] == false)) {
    header('Location: index.php');
    exit();
}

require_once "php/chat.php";
if (isset($_GET['cid'])){
    $id_conv = $_GET['cid'];
    $_SESSION['id_conv'] = $id_conv;
    getChatData($id_conv);
}

if (isset($_POST['message-field']))
{
    $mess = $_POST['message-field'];
    addMessage($mess);
}

?>

<!-- TODO html for chat -->
