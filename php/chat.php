<?php
function getChatData($conv){
    require "connect.php";
    require_once "HandleJson.php";

    $query_to = "SELECT distinct c.topic from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message";
    $query_iu = "SELECT distinct m.id_user from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message limit 1";
    $query_is = "SELECT distinct m.id_sender from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message limit 1";
    $query_po = "SELECT distinct p.position from conv_part cp join users u on u.id_user=cp.id_user join applicants app on app.id_user=u.id_user join applications a on a.id_applicants=app.id_applicants join positions p on p.id_position=a.id_position join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message order by m.time";
    $query_me = "SELECT m.message from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message order by m.time";
    $query_ti = "SELECT m.time from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message order by m.time";
    $query_id = "SELECT distinct u.id_user, us.id_user from users u join messages m on m.id_user=u.id_user join users us on us.id_user=m.id_sender join conv c on c.id_conv=m.id_conv where c.id_conv = {$conv} group by m.id_message order by m.time limit 2";
    $query_na = "SELECT distinct u.name, us.name from users u join messages m on m.id_user=u.id_user join users us on us.id_user=m.id_sender join conv c on c.id_conv=m.id_conv where c.id_conv = {$conv} group by m.id_message order by m.time limit 2";
    $query_su = "SELECT distinct u.surname, us.surname from users u join messages m on m.id_user=u.id_user join users us on us.id_user=m.id_sender join conv c on c.id_conv=m.id_conv where c.id_conv = {$conv} group by m.id_message order by m.time limit 2";
    $query_ro = "SELECT distinct r.name_role, r2.name_role from users u join messages m on m.id_user=u.id_user join users us on us.id_user=m.id_sender join conv c on c.id_conv=m.id_conv join roles r on r.id_role=u.id_role join roles r2 on r2.id_role=us.id_role where c.id_conv = {$conv} group by m.id_message order by m.time limit 2";
    $query_se = "SELECT m.id_sender from conv_part cp join users u on u.id_user=cp.id_user join conv c on c.id_conv=cp.id_conv join messages m on m.id_conv=c.id_conv join users us on us.id_user=m.id_sender where c.id_conv = {$conv} group by m.id_message order by m.time";

    $data_push_to = array();
    $data_push_iu = array();
    $data_push_is = array();
    $data_push_po = array();
    $data_push_me = array(); $data_push_ti = array();
    $data_push_id = array();
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
        $count_id = $new_json->fetchData($query_id, $data_push_id, $json_array['userId'], $host, $db_user, $db_pass, $db_name);
        $count_na = $new_json->fetchData($query_na, $data_push_na, $json_array['userName'], $host, $db_user, $db_pass, $db_name);
        $count_su = $new_json->fetchData($query_su, $data_push_su, $json_array['userSurname'], $host, $db_user, $db_pass, $db_name);
        $count_ro = $new_json->fetchData($query_ro, $data_push_ro, $json_array['userRole'], $host, $db_user, $db_pass, $db_name);
        $count_se = $new_json->fetchData($query_se, $data_push_se, $json_array['senderId'], $host, $db_user, $db_pass, $db_name);

        $new_json->addCounters($json_array['counters']['messages'], $count_me);

        //fill .json file with data from db
        $new_json->createJsonFile('json/chat.json', $json_array);
    } catch (Exception $e) {
        require_once "addError.php";
        addError($e);
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
    }
}

function addMessage($mess, $usr){
    require "connect.php";
    require_once "HandleJson.php";
    require_once "FormsValidation.php";

    $vali = new FormsValidation(true);

    // validate message
    if (!preg_match('/^[a-z0-9\040.\-]+$/i', $mess)) {
        $vali->setFlag(false);
        $_SESSION["err_message"] = 'Message cannot contain special characters';
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
                $select = $connection->query("select id_conv_part from conv_part where id_conv = '{$_SESSION['id_conv']}'");
                $select_counter = $select->num_rows;
                if ($select_counter == 0)
                    $ins = $connection->query("insert into conv_part (id_conv_part, id_conv, id_user) values (null, {$_SESSION['id_conv']}, {$_SESSION['id_user']})");
                if ($ins = $connection->query("insert into messages (id_message, id_sender, message, time, id_conv, id_user) values (null, {$_SESSION['id_user']}, '{$mess}', '{$timestamp}', {$_SESSION['id_conv']}, {$user})")){
                    header("Location: chat.php?cid=" . $_SESSION['id_conv']);
                    unset($_SESSION['id_conv']);
                }
                else
                    throw new Exception($connection->error);
            }
            $connection->close();
        } catch (Exception $e) {
            require_once "addError.php";
            addError($e);
            echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
        }
    }
}

function addNewConv($mess, $topic, $usr) {
    require "connect.php";
    require_once "HandleJson.php";
    require_once "FormsValidation.php";

    $vali = new FormsValidation(true);
    // validate message
    if (!preg_match('/^[a-z0-9\040.\-]+$/i', $mess)) {
        $vali->setFlag(false);
        $_SESSION["err_message"] = 'Message cannot contain special characters';
    }
    if (!preg_match('/^[a-z0-9\040.\-]+$/i', $topic)) {
        $vali->setFlag(false);
        $_SESSION["err_topic"] = 'Topic cannot contain special characters';
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
                if ($connection->query("insert into conv (id_conv, topic) values (null, '{$topic}')"))
                {
                    $select = $connection->query("select id_conv from conv order by id_conv desc limit 1");
                    $idc = $select->fetch_assoc();
                    $id_conv = intval($idc['id_conv']);
                    $select = $connection->query("select id_conv_part from conv_part where id_conv = '{$idc['id_conv']}'");
                    $select_counter = $select->num_rows;
                    if ($select_counter == 0)
                        $ins = $connection->query("insert into conv_part (id_conv_part, id_conv, id_user) values (null, {$idc['id_conv']}, {$_SESSION['id_user']})");
                    if ($ins = $connection->query("insert into messages (id_message, id_sender, message, time, id_conv, id_user) values (null, {$_SESSION['id_user']}, '{$mess}', '{$timestamp}', {$id_conv}, {$user})")){
                        header("Location: chat.php?cid=" . $idc['id_conv']);
                    }
                    else
                        throw new Exception($connection->error);
                } else
                    throw new Exception($connection->error);

            }
            $connection->close();
        } catch (Exception $e) {
            require_once "addError.php";
            addError($e);
            echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
        }
    }
}

function getUserName($id, $uid){
    require "connect.php";
    require_once "HandleJson.php";

    $query_iu = "SELECT u.name from users u join applicants a on a.id_user=u.id_user join applications ap on ap.id_applicants=a.id_applicants where ap.id_application = {$id}";
    $query_is = "SELECT u.surname from users u join applicants a on a.id_user=u.id_user join applications ap on ap.id_applicants=a.id_applicants where ap.id_application = {$id}";
    $query_ip = "SELECT p.position from positions p join applications ap on ap.id_position=p.id_position where ap.id_application = {$id}";
    $query_ir = "SELECT r.name_role from roles r join users u on u.id_role=r.id_role where u.id_user = {$uid}";

    $data_push_iu = array();
    $data_push_is = array();
    $data_push_ip = array();
    $data_push_ir = array();

    $json_array = array();
    $new_json = new HandleJson();

    // connect with db
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        // add db results to array
        $count_iu = $new_json->fetchData($query_iu, $data_push_iu, $json_array['personalData']['name'], $host, $db_user, $db_pass, $db_name);
        $count_is = $new_json->fetchData($query_is, $data_push_is, $json_array['personalData']['surname'], $host, $db_user, $db_pass, $db_name);
        $count_ip = $new_json->fetchData($query_ip, $data_push_ip, $json_array['personalData']['position'], $host, $db_user, $db_pass, $db_name);
        $count_ir = $new_json->fetchData($query_ir, $data_push_ir, $json_array['personalData']['role'], $host, $db_user, $db_pass, $db_name);

        //fill .json file with data from db
        $new_json->createJsonFile('json/write_msg_user.json', $json_array);
    } catch (Exception $e) {
        require_once "addError.php";
        addError($e);
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
    }
}