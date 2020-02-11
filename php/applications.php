<?php
function getApplicationsData($condition){
    require "connect.php";
    require_once "HandleJson.php";

    $query_e = "SELECT u.id_user from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position WHERE {$condition}";
    $query_a = "SELECT ap.id_application from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position WHERE {$condition}";
    $query_n = "SELECT u.name from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position WHERE {$condition}";
    $query_su = "SELECT u.surname from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position WHERE {$condition}";
    $query_p = "SELECT p.position from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position WHERE {$condition}";
    $query_d = "SELECT p.description from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position WHERE {$condition}";
    $query_ns = "SELECT s.name_status from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position WHERE {$condition}";
    $query_st = "SELECT sor.name_stage from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join sor sor on ap.id_application=sor.id_application join positions p on ap.id_position=p.id_position WHERE {$condition}";
    $query_de = "SELECT d.name_decision from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join decisions d on d.id_decision=ap.id_decision join statuses s on ap.id_status=s.id_status join sor sor on ap.id_application=sor.id_application join positions p on ap.id_position=p.id_position WHERE {$condition}";
    $data_push_e = array(); $data_push_a = array(); $data_push_n = array(); $data_push_su = array(); $data_push_p = array(); $data_push_d = array(); $data_push_ns = array(); $data_push_st = array(); //$data_push_idc = array(); $data_push_t = array();
    $data_push_de = array();
    $json_array = array();

    $new_json = new HandleJson();
    mysqli_report(MYSQLI_REPORT_STRICT);
    try
    {
        $count_results_e = $new_json->fetchData($query_e, $data_push_e, $json_array['applications']['personalData']['idUser'], $host, $db_user, $db_pass, $db_name);
        $count_results_a = $new_json->fetchData($query_a, $data_push_a, $json_array['applications']['personalData']['idApplication'], $host, $db_user, $db_pass, $db_name);
        $count_results_n = $new_json->fetchData($query_n, $data_push_n, $json_array['applications']['personalData']['name'], $host, $db_user, $db_pass, $db_name);
        $count_results_su = $new_json->fetchData($query_su, $data_push_su, $json_array['applications']['personalData']['surname'], $host, $db_user, $db_pass, $db_name);
        $count_results_p = $new_json->fetchData($query_p, $data_push_p, $json_array['applications']['position'], $host, $db_user, $db_pass, $db_name);
        $count_results_d = $new_json->fetchData($query_d, $data_push_d, $json_array['applications']['description'], $host, $db_user, $db_pass, $db_name);
        $count_results_ns = $new_json->fetchData($query_ns, $data_push_ns, $json_array['applications']['status'], $host, $db_user, $db_pass, $db_name);
        $count_results_st = $new_json->fetchData($query_st, $data_push_st, $json_array['applications']['stage'], $host, $db_user, $db_pass, $db_name);
        $count_results_de = $new_json->fetchData($query_de, $data_push_de, $json_array['applications']['decision'], $host, $db_user, $db_pass, $db_name);
        $new_json->addCounters($json_array['counters']['name'], $count_results_n);
        $new_json->addCounters($json_array['counters']['position'], $count_results_p);
        $new_json->addCounters($json_array['counters']['description'], $count_results_d);
        $new_json->addCounters($json_array['counters']['status'], $count_results_ns);
        $new_json->addCounters($json_array['counters']['decision'], $count_results_de);
        $new_json->createJsonFile('json/applications.json', $json_array);
    }
    catch (Exception $e)
    {
        require_once "addError.php";
        addError($e);
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
    }
}
@session_start();
if (isset($_POST['position'])) {
    $position = $_POST['position'];
            require_once "connect.php";
            mysqli_report(MYSQLI_REPORT_STRICT);
            try{
                $conn = new mysqli($host, $db_user, $db_pass, $db_name);
                if ($conn->connect_errno!=0){
                    throw new Exception($conn->error);
                } else {
                    $adi = $conn->query("select id_applicants from applicants where id_user={$_SESSION['id_user']}");
                    $t_adi = $adi->fetch_assoc();
                    $id_appcant = $t_adi['id_applicants'];
                    $timestamp = date("Y-m-d");
                    $pdi = $conn->query("select id_position from positions where position='{$position}'");
                    $t_pdi = $pdi->fetch_assoc();
                    $id_pos = $t_pdi['id_position'];
                    $cdi = $conn->query("select id_cl from cl order by id_cl desc limit 1");
                    $t_cdi = $cdi->fetch_assoc();
                    $fuc = intval($t_cdi['id_cl']);
                    $id_cl = $fuc++;
                    if($conn->query("insert into applications (id_application, id_applicants, id_decision, id_position, id_status, id_cl, date, id_conv) values (null, {$id_appcant}, 4, {$id_pos}, 1, {$id_cl}, '{$timestamp}', null)")){
                        $aadi = $conn->query("select id_application from applications order by id_application desc limit 1");
                        $t_aadi = $aadi->fetch_assoc();
                        $id_appcation = $t_aadi['id_application'];
                        if($conn->query("insert into cl (id_cl, description, id_application) values (null, '{$name}', {$id_appcation})")){
                            header("Location: /applications.php?aP=success");
                        }
                    }
                }
            } catch (Exception $e){
                require_once "addError.php";
                addError($e);
                echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
            }
}