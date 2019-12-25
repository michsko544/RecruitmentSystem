<?php

function getRepliesData($user){
    require_once "connect.php";
    require_once "HandleJson.php";

    // TODO finish it replies

    $new_json = new HandleJson();

// connect with db
    mysqli_report(MYSQLI_REPORT_STRICT);
    try
    {
        // add db results to array
        $count_tpd = $new_json->fetchData($query_temail, $data_push_temail, $json_array['email'], $host, $db_user, $db_pass, $db_name);

        $new_json->addCounters($json_array['counters']['personalData'], $count_tpd);


        //fill .json file with data from db
        $new_json->createJsonFile('json/profile.json', $json_array);
    }
    catch (Exception $e)
    {
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
    }

}