<?php
class ManageUsers extends HandleJson {

function __construct($host, $db_user, $db_pass, $db_name)
{
    $conn = new mysqli($host, $db_user, $db_pass, $db_name);
}

function getUsers(){
$query_id = "select id_user from users";
$query_lo = "select login from users";
$query_na = "select name from users";
$query_su = "select surname from users";

$array_id = array(); $array_lo = array();$array_na = array();$array_su = array();

$json_array = array();

    $this->fetchData($query_id, $array_id, $json_array['users']['idUser'], $host, $db_user, $db_pass, $db_name)

}

function blockUser($user){

}

function removeUser($user){

}
}
