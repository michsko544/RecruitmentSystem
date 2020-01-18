<?php
function getRole($host, $db_user, $db_pass, $db_name){
    require_once "HandleJson.php";
     $array = array();
     $json = new HandleJson();
     if (isset($_SESSION['id_role'])){
         $conn = new mysqli($host, $db_user, $db_pass, $db_name);
         $query = $conn->query("select name_role from roles where id_role = {$_SESSION['id_role']}");
         $assoc = $query->fetch_assoc();
         $role = $assoc['name_role'];
         $array['role'] = $role;
         $json->createJsonFile("../json/role.json", $array);
     }

}