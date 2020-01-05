<?php
function getChatData($conv){
    require_once "connect.php";
    require_once "HandleJson.php";

    $query_to = "SELECT distinct c.topic from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message";
    $query_iu = "SELECT distinct m.id_user from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message limit 1";
    $query_is = "SELECT distinct m.id_sender from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message limit 1";
    $query_po = "SELECT distinct p.position from conv_part cp join users u on u.id_user=cp.id_user join applicants app on app.id_user=u.id_user join applications a on a.id_applicants=app.id_applicants join positions p on p.id_position=a.id_position join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message order by m.time";
    $query_me = "SELECT m.message from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message order by m.time";
    $query_ti = "SELECT m.time from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message order by m.time";
    $query_na = "SELECT us.name as senderName from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message order by m.time";
    $query_su = "SELECT us.surname as senderSurname from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message order by m.time";
    $query_ro = "SELECT r.name_role as senderRole from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender join roles r on r.id_role=us.id_role where c.id_conv = {$conv} group by m.id_message order by m.time";
    $query_se = "SELECT m.id_sender from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message order by m.time";

    $data_push_to = array();
    $data_push_iu = array();
    $data_push_is = array();
    $data_push_po = array();
    $data_push_me = array(); $data_push_ti = array();
    $data_push_na = array(); $data_push_su = array();
    $data_push_ro = array();
    $data_push_se = array();
    $json_array = array();

    $new_json = new HandleJson();

    // connect with db
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        // add db results to array
        $count_lo = $json_array['idLoggedUser'] = $_SESSION['id_user'];
        $count_iu = $new_json->fetchData($query_iu, $data_push_iu, $json_array['idUser'], $host, $db_user, $db_pass, $db_name);
        $count_is = $new_json->fetchData($query_is, $data_push_is, $json_array['idUser2'], $host, $db_user, $db_pass, $db_name);
        $count_to = $new_json->fetchData($query_to, $data_push_to, $json_array['topic'], $host, $db_user, $db_pass, $db_name);
        $count_po = $new_json->fetchData($query_po, $data_push_po, $json_array['position'], $host, $db_user, $db_pass, $db_name);
        $count_me = $new_json->fetchData($query_me, $data_push_me, $json_array['message'], $host, $db_user, $db_pass, $db_name);
        $count_ti = $new_json->fetchDataTime($query_ti, $data_push_ti, $json_array['time'], $host, $db_user, $db_pass, $db_name);
        $count_na = $new_json->fetchData($query_na, $data_push_na, $json_array['senderName'], $host, $db_user, $db_pass, $db_name);
        $count_su = $new_json->fetchData($query_su, $data_push_su, $json_array['senderSurname'], $host, $db_user, $db_pass, $db_name);
        $count_ro = $new_json->fetchData($query_ro, $data_push_ro, $json_array['senderRole'], $host, $db_user, $db_pass, $db_name);
        $count_se = $new_json->fetchData($query_se, $data_push_se, $json_array['senderId'], $host, $db_user, $db_pass, $db_name);

        $new_json->addCounters($json_array['counters']['messages'], $count_me);

        //fill .json file with data from db
        $new_json->createJsonFile('json/chat.json', $json_array);
    } catch (Exception $e) {
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
    }
}

function addMessage($mess, $usr){
    require_once "connect.php";
    require_once "HandleJson.php";
    require_once "FormsValidation.php";

    $vali = new FormsValidation(true);

    // validate message
    if (!preg_match('/^[a-z0-9\040.\-]+$/i', $mess)) {
        $vali->notGood('err_message', 'message cannot contain special characters');
    }
    if ($vali->checkFlag() == true){
        try{
            $connection = new mysqli($host, $db_user, $db_pass, $db_name);
            if ($connection->connect_errno != 0) {
                throw new Exception(mysqli_connect_errno());
            }
            else {
                $timestamp = date("Y-m-d H:i:s");
                $user = intval($usr);
                // TODO add handleJson query with id_sender

                $ins = $connection->query("insert into conv_part (id_conv_part, id_conv, id_user) values (null, {$_SESSION['id_conv']}, {$_SESSION['id_user']})");
                // $ins = $connection->query("insert into conv_part (id_conv_part, id_conv, id_user) values (null, {$_SESSION['id_conv']}, {$user})"); // query->where->OR probably solves this problem
                if ($ins = $connection->query("insert into messages (id_message, id_sender, message, time, id_conv, id_user) values (null, {$_SESSION['id_user']}, '{$mess}', '{$timestamp}', {$_SESSION['id_conv']}, {$user})")){
                    header("Location: chat.php?cid=" . $_SESSION['id_conv']);
                    unset($_SESSION['id_conv']);
                }
                else
                    throw new Exception($connection->error);
            }
            $connection->close();
        } catch (Exception $e) {
            echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
        }
    }


}