<?php
function getRepliesData($user){
    require_once "connect.php";
    require_once "HandleJson.php";

    $query_id = "SELECT c.id_conv FROM users u join messages m on u.id_user=m.id_user join conv c on m.id_conv=c.id_conv join users u1 on u1.id_user=m.id_sender where u.id_user = '{$user}' group by c.id_conv";
    $query_to = "SELECT c.topic FROM users u join messages m on u.id_user=m.id_user join conv c on m.id_conv=c.id_conv join users u1 on u1.id_user=m.id_sender where u.id_user = '{$user}' group by c.id_conv";
    $query_ti = "SELECT m.time FROM users u join messages m on u.id_user=m.id_user join conv c on m.id_conv=c.id_conv join users u1 on u1.id_user=m.id_sender where u.id_user = '{$user}' group by c.id_conv";
    $query_na = "SELECT u1.name FROM users u join messages m on u.id_user=m.id_user join conv c on m.id_conv=c.id_conv join users u1 on u1.id_user=m.id_sender where u.id_user = '{$user}' group by c.id_conv";
    $query_su = "SELECT u1.surname FROM users u join messages m on u.id_user=m.id_user join conv c on m.id_conv=c.id_conv join users u1 on u1.id_user=m.id_sender where u.id_user = '{$user}' group by c.id_conv";
    $query_ro = "SELECT r.name_role FROM users u join messages m on u.id_user=m.id_user join conv c on m.id_conv=c.id_conv join users u1 on u1.id_user=m.id_sender join roles r on r.id_role=u1.id_role where u.id_user = '{$user}' group by c.id_conv";
    $query_po = "SELECT c.topic, p.position FROM users u join applicants app on app.id_user=u.id_user join applications a on a.id_applicants=app.id_applicants join positions p on p.id_position=a.id_position join messages m on u.id_user=m.id_user join conv c on m.id_conv=c.id_conv join users u1 on u1.id_user=m.id_sender where u.id_user = '{$user}' group by c.id_conv";

    $data_push_id = array(); $data_push_to = array();
    $data_push_ti = array();
    $data_push_na = array(); $data_push_su = array();
    $data_push_ro = array();
    $data_push_po = array();
    $json_array = array();

    $new_json = new HandleJson();

    // connect with db
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        // add db results to array
        $count_id = $new_json->fetchData($query_id, $data_push_id, $json_array['idConv'], $host, $db_user, $db_pass, $db_name);
        $count_to = $new_json->fetchData($query_to, $data_push_to, $json_array['topic'], $host, $db_user, $db_pass, $db_name);
        $count_ti = $new_json->fetchData($query_ti, $data_push_ti, $json_array['time'], $host, $db_user, $db_pass, $db_name);
        $count_na = $new_json->fetchData($query_na, $data_push_na, $json_array['fromUser']['name'], $host, $db_user, $db_pass, $db_name);
        $count_su = $new_json->fetchData($query_su, $data_push_su, $json_array['fromUser']['surname'], $host, $db_user, $db_pass, $db_name);
        $count_ro = $new_json->fetchData($query_ro, $data_push_ro, $json_array['fromUser']['idRole'], $host, $db_user, $db_pass, $db_name);
        $count_po = $new_json->fetchData($query_po, $data_push_po, $json_array['position'], $host, $db_user, $db_pass, $db_name);

        $new_json->addCounters($json_array['counters']['message'], $count_id);

        //fill .json file with data from db
        $new_json->createJsonFile('json/replies.json', $json_array);
    } catch (Exception $e) {
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
    }
}