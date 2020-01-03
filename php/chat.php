<?php
function getChatData($conv){
    require_once "connect.php";
    require_once "HandleJson.php";

    $query_to = "SELECT c.topic from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message";
    $query_me = "SELECT m.message from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message";
    $query_ti = "SELECT m.time from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message";
    $query_na = "SELECT us.name as senderName from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message";
    $query_su = "SELECT us.surname as senderSurname from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message";
    $query_ro = "SELECT us.id_role as senderRole from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message";
    $query_se = "SELECT m.id_sender from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message";

    $data_push_to = array(); $data_push_me = array(); $data_push_ti = array(); $data_push_na = array(); $data_push_su = array();$data_push_ro = array();$data_push_se = array();
    $json_array = array();

    $new_json = new HandleJson();

    // connect with db
    mysqli_report(MYSQLI_REPORT_STRICT);
    try
    {
        // add db results to array
        $count_to = $new_json->fetchData($query_to, $data_push_to, $json_array['topic'], $host, $db_user, $db_pass, $db_name);
        $count_me = $new_json->fetchData($query_me, $data_push_me, $json_array['message'], $host, $db_user, $db_pass, $db_name);
        $count_ti = $new_json->fetchData($query_ti, $data_push_ti, $json_array['time'], $host, $db_user, $db_pass, $db_name);
        $count_na = $new_json->fetchData($query_na, $data_push_na, $json_array['senderName'], $host, $db_user, $db_pass, $db_name);
        $count_su = $new_json->fetchData($query_su, $data_push_su, $json_array['senderSurname'], $host, $db_user, $db_pass, $db_name);
        $count_ro = $new_json->fetchData($query_ro, $data_push_ro, $json_array['senderRole'], $host, $db_user, $db_pass, $db_name);
        $count_se = $new_json->fetchData($query_se, $data_push_se, $json_array['senderId'], $host, $db_user, $db_pass, $db_name);

        $new_json->addCounters($json_array['counters']['messages'], $count_to);


        //fill .json file with data from db
        $new_json->createJsonFile('json/chat.json', $json_array);
    }
    catch (Exception $e)
    {
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
    }

}