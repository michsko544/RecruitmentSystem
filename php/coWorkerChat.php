<?php
session_start();
if ((!isset($_SESSION['logged_in'])) || ($_SESSION['logged_in'] == false))
{
    header('Location: index.php');
    exit();
}

if (isset($_POST['co-worker'])){
    $rcpt = intval($_POST['co-worker']);
    header("Location: ../write-msg.php?uid=" . $rcpt);
}