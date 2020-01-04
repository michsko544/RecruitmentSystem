<?php
$usr = $_GET['uid'];
if (isset($_POST['message-field']))
{
    $mess = $_POST['message-field'];
    addMessage($mess, $usr);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recruitment System - Write message</title>
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <link rel="stylesheet" href="/font/stylesheet.css" type="text/css" charset="utf-8" />
</head>
<body>
<!-- TODO nie zmieniaj name'ów w inputach -->
<form action="" method="post">
<input type="text" name="message-field"/>
<input type="submit" name="submit" value="Send"/>
</form>
</body>
