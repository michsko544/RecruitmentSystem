<?php

function getRepliesData($user){
    require_once "connect.php";
    require_once "HandleJson.php";
    // TODO check if queries are correct
    $query_to = "SELECT c.topic FROM users u join conv_part cp on cp.id_user=u.id_user join messages m on m.id_conv=cp.id_conv join conv c on c.id_conv=m.id_conv and c.id_conv=cp.id_conv WHERE u.id_user='{$user}'";
    $query_ti = "SELECT m.time FROM users u join conv_part cp on cp.id_user=u.id_user join messages m on m.id_conv=cp.id_conv join conv c on c.id_conv=m.id_conv and c.id_conv=cp.id_conv WHERE u.id_user='{$user}'";
    $query_se = "SELECT m.id_sender FROM users u join conv_part cp on cp.id_user=u.id_user join messages m on m.id_conv=cp.id_conv join conv c on c.id_conv=m.id_conv and c.id_conv=cp.id_conv WHERE u.id_user='{$user}'";

    $data_push_to = array(); $data_push_ti = array(); $data_push_se = array();
    $json_array = array();

    $new_json = new HandleJson();

// connect with db
    mysqli_report(MYSQLI_REPORT_STRICT);
    try
    {
        // add db results to array
        $count_to = $new_json->fetchData($query_to, $data_push_to, $json_array['topic'], $host, $db_user, $db_pass, $db_name);
        $count_ti = $new_json->fetchData($query_ti, $data_push_ti, $json_array['time'], $host, $db_user, $db_pass, $db_name);
        $count_se = $new_json->fetchData($query_se, $data_push_se, $json_array['fromUser'], $host, $db_user, $db_pass, $db_name);

        $new_json->addCounters($json_array['counters']['message'], $count_to);


        //fill .json file with data from db
        $new_json->createJsonFile('json/replies.json', $json_array);
    }
    catch (Exception $e)
    {
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
    }

}