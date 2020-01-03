<?php
session_start();
if ((!isset($_SESSION['logged_in'])) || ($_SESSION['logged_in'] == false))
{
    header('Location: index.php');
    exit();
}

require_once "php/chat.php";
$id_conv = $_GET['id-conv'];
getChatData($id_conv);
?>

<!-- TODO html for chat -->
