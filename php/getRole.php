<?php
function getRole($host, $db_user, $db_pass, $db_name){

    require "connect.php";
    require_once "HandleJson.php";
     $array = array();
     $json = new HandleJson();
     if (isset($_SESSION['id_role'])){
         mysqli_report(MYSQLI_REPORT_STRICT);
         try{
             $conn = new mysqli($host, $db_user, $db_pass, $db_name);
             if ($conn->connect_errno != 0) {
                throw new Exception(mysqli_connect_errno());
             } else {
                 if ($query = $conn->query("select name_role from roles where id_role = {$_SESSION['id_role']}")){
                     $assoc = $query->fetch_assoc();
                     $role = $assoc['name_role'];
                     $array['role'] = $role;
                     $json->createJsonFile("json/role.json", $array);
                 } else {
                     throw new Exception($conn->error);
                 }
                 $conn->close();
             }
         } catch (Exception $e){
             require_once "addError.php";
             addError($e);
             echo "<div class='server-error'>Server error! Please try again later. Err: " . $e . "</div>";
         }
     }

}