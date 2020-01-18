<?php
function getRepliesData($user){
    require "connect.php";
    require_once "HandleJson.php";

    $query_id = "SELECT c.id_conv FROM users u join messages m on u.id_user=m.id_user join conv c on m.id_conv=c.id_conv join conv_part cp on cp.id_conv=c.id_conv join users u1 on u1.id_user=m.id_sender where m.id_user = '{$user}' or m.id_sender = '{$user}' group by c.id_conv order by m.time";
    $query_to = "SELECT c.topic FROM users u join messages m on u.id_user=m.id_user join conv c on m.id_conv=c.id_conv join conv_part cp on cp.id_conv=c.id_conv join users u1 on u1.id_user=m.id_sender where m.id_user = '{$user}' or m.id_sender = '{$user}' group by c.id_conv order by m.time";
    $query_ti = "SELECT MAX(m.time) FROM users u join messages m on u.id_user=m.id_user join conv c on m.id_conv=c.id_conv join conv_part cp on cp.id_conv=c.id_conv join users u1 on u1.id_user=m.id_sender where m.id_user = '{$user}' or m.id_sender = '{$user}' group by c.id_conv order by m.time";
    $query_iu = "SELECT u1.id_user FROM users u join messages m on u.id_user=m.id_user join conv c on m.id_conv=c.id_conv join conv_part cp on cp.id_conv=c.id_conv join users u1 on u1.id_user=m.id_sender where m.id_user = '{$user}' or m.id_sender = '{$user}' group by c.id_conv order by m.time";
    $query_na = "SELECT u1.name FROM users u join messages m on u.id_user=m.id_user join conv c on m.id_conv=c.id_conv join conv_part cp on cp.id_conv=c.id_conv join users u1 on u1.id_user=m.id_sender where m.id_user = '{$user}' or m.id_sender = '{$user}' group by c.id_conv order by m.time";
    $query_su = "SELECT u1.surname FROM users u join messages m on u.id_user=m.id_user join conv c on m.id_conv=c.id_conv join conv_part cp on cp.id_conv=c.id_conv join users u1 on u1.id_user=m.id_sender where m.id_user = '{$user}' or m.id_sender = '{$user}' group by c.id_conv order by m.time";
    $query_ro = "SELECT r.name_role FROM users u join messages m on u.id_user=m.id_user join conv c on m.id_conv=c.id_conv join conv_part cp on cp.id_conv=c.id_conv join users u1 on u1.id_user=m.id_sender join roles r on r.id_role=u1.id_role where m.id_user = '{$user}' or m.id_sender = '{$user}' group by c.id_conv order by m.time";
    $query_i2 = "SELECT u.id_user FROM users u join messages m on u.id_user=m.id_user join conv c on m.id_conv=c.id_conv join conv_part cp on cp.id_conv=c.id_conv join users u1 on u1.id_user=m.id_sender where m.id_user = '{$user}' or m.id_sender = '{$user}' group by c.id_conv order by m.time";
    $query_n2 = "SELECT u.name FROM users u join messages m on u.id_user=m.id_user join conv c on m.id_conv=c.id_conv join conv_part cp on cp.id_conv=c.id_conv join users u1 on u1.id_user=m.id_sender where m.id_user = '{$user}' or m.id_sender = '{$user}' group by c.id_conv order by m.time";
    $query_s2 = "SELECT u.surname FROM users u join messages m on u.id_user=m.id_user join conv c on m.id_conv=c.id_conv join conv_part cp on cp.id_conv=c.id_conv join users u1 on u1.id_user=m.id_sender where m.id_user = '{$user}' or m.id_sender = '{$user}' group by c.id_conv order by m.time";
    $query_r2 = "SELECT r.name_role FROM users u join messages m on u.id_user=m.id_user join conv c on m.id_conv=c.id_conv join conv_part cp on cp.id_conv=c.id_conv join users u1 on u1.id_user=m.id_sender join roles r on r.id_role=u.id_role where m.id_user = '{$user}' or m.id_sender = '{$user}' group by c.id_conv order by m.time";
    $query_po = "SELECT p.position FROM users u join applicants app on app.id_user=u.id_user join applications a on a.id_applicants=app.id_applicants join positions p on p.id_position=a.id_position join messages m on u.id_user=m.id_user join conv c on m.id_conv=c.id_conv join conv_part cp on cp.id_conv=c.id_conv join users u1 on u1.id_user=m.id_sender where m.id_user = '{$user}' or m.id_sender = '{$user}' group by c.id_conv order by m.time";

    $data_push_id = array(); $data_push_to = array();
    $data_push_ti = array();
    $data_push_iu = array();
    $data_push_na = array(); $data_push_su = array();
    $data_push_ro = array();
    $data_push_i2 = array();
    $data_push_n2 = array(); $data_push_s2 = array();
    $data_push_r2 = array();
    $data_push_po = array();
    $json_array = array();

    $new_json = new HandleJson();

    // connect with db
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        // add db results to array
        $count_lo = $json_array['idLoggedUser'] = $_SESSION['id_user'];
        $count_id = $new_json->fetchData($query_id, $data_push_id, $json_array['idConv'], $host, $db_user, $db_pass, $db_name);
        $count_to = $new_json->fetchData($query_to, $data_push_to, $json_array['topic'], $host, $db_user, $db_pass, $db_name);
        $count_ti = $new_json->fetchDataTime($query_ti, $data_push_ti, $json_array['time'], $host, $db_user, $db_pass, $db_name);
        $count_iu = $new_json->fetchData($query_iu, $data_push_iu, $json_array['fromUser']['idUser'], $host, $db_user, $db_pass, $db_name);
        $count_na = $new_json->fetchData($query_na, $data_push_na, $json_array['fromUser']['name'], $host, $db_user, $db_pass, $db_name);
        $count_su = $new_json->fetchData($query_su, $data_push_su, $json_array['fromUser']['surname'], $host, $db_user, $db_pass, $db_name);
        $count_ro = $new_json->fetchData($query_ro, $data_push_ro, $json_array['fromUser']['idRole'], $host, $db_user, $db_pass, $db_name);
        $count_i2 = $new_json->fetchData($query_i2, $data_push_i2, $json_array['toUser']['idUser'], $host, $db_user, $db_pass, $db_name);
        $count_n2 = $new_json->fetchData($query_n2, $data_push_n2, $json_array['toUser']['name'], $host, $db_user, $db_pass, $db_name);
        $count_s2 = $new_json->fetchData($query_s2, $data_push_s2, $json_array['toUser']['surname'], $host, $db_user, $db_pass, $db_name);
        $count_r2 = $new_json->fetchData($query_r2, $data_push_r2, $json_array['toUser']['idRole'], $host, $db_user, $db_pass, $db_name);
        $count_po = $new_json->fetchData($query_po, $data_push_po, $json_array['position'], $host, $db_user, $db_pass, $db_name);

        for ($i = 0; $i < $count_id; $i++){
            if ($_SESSION['id_user'] == $json_array['fromUser']['idUser'][$i]) {
                $json_array['fromUser']['idUser'][$i] = $json_array['toUser']['idUser'][$i];
                $json_array['fromUser']['name'][$i] = $json_array['toUser']['name'][$i];
                $json_array['fromUser']['surname'][$i] = $json_array['toUser']['surname'][$i];
                $json_array['fromUser']['idRole'][$i] = $json_array['toUser']['idRole'][$i];
            }
        }
        $new_json->addCounters($json_array['counters']['message'], $count_id);

        //fill .json file with data from db
        $new_json->createJsonFile('json/replies.json', $json_array);
    } catch (Exception $e) {
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
    }
}