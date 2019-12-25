<?php

class Applications
{
    private $user = null;

    function __construct(){
        // TODO class or functions ?  (profile, applications)
    }

    function getApplicationsData(){
        require_once "connect.php";
        require_once "HandleJson.php";

        $query_n = "SELECT u.name from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position join messages m on u.id_user=u.id_user join conv c on m.id_conv=c.id_conv WHERE u.id_user = '{$_SESSION['id_user']}'";
        $query_p = "SELECT p.position from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position join messages m on u.id_user=u.id_user join conv c on m.id_conv=c.id_conv WHERE u.id_user = '{$_SESSION['id_user']}'";
        $query_d = "SELECT p.description from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position join messages m on u.id_user=u.id_user join conv c on m.id_conv=c.id_conv WHERE u.id_user = '{$_SESSION['id_user']}'";
        $query_ns = "SELECT s.name_status from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position join messages m on u.id_user=u.id_user join conv c on m.id_conv=c.id_conv WHERE u.id_user = '{$_SESSION['id_user']}'";
        $query_idc = "SELECT c.id_conv from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position join messages m on u.id_user=u.id_user join conv c on m.id_conv=c.id_conv WHERE u.id_user = '{$_SESSION['id_user']}'";
        $query_t = "SELECT c.topic from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position join messages m on u.id_user=u.id_user join conv c on m.id_conv=c.id_conv WHERE u.id_user = '{$_SESSION['id_user']}'";
        $data_push_n = array(); $data_push_p = array(); $data_push_d = array(); $data_push_ns = array(); $data_push_idc = array(); $data_push_t = array();
        $json_array = array();

        $new_json = new HandleJson();
        try
        {
            $count_results_n = $new_json->fetchData($query_n, $data_push_n, $json_array['applications']['name'], $host, $db_user, $db_pass, $db_name);
            $count_results_p = $new_json->fetchData($query_p, $data_push_p, $json_array['applications']['position'], $host, $db_user, $db_pass, $db_name);
            $count_results_d = $new_json->fetchData($query_d, $data_push_d, $json_array['applications']['description'], $host, $db_user, $db_pass, $db_name);
            $count_results_ns = $new_json->fetchData($query_ns, $data_push_ns, $json_array['applications']['status'], $host, $db_user, $db_pass, $db_name);
            $count_results_idc = $new_json->fetchData($query_idc, $data_push_idc, $json_array['applications']['idConv'], $host, $db_user, $db_pass, $db_name);
            $count_results_t = $new_json->fetchData($query_t, $data_push_t, $json_array['applications']['convTopic'], $host, $db_user, $db_pass, $db_name);
            $new_json->addCounters($json_array['counters']['name'], $count_results_n);
            $new_json->addCounters($json_array['counters']['position'], $count_results_p);
            $new_json->addCounters($json_array['counters']['description'], $count_results_d);
            $new_json->addCounters($json_array['counters']['status'], $count_results_ns);
            $new_json->addCounters($json_array['counters']['idConv'], $count_results_idc);
            $new_json->addCounters($json_array['counters']['convTopic'], $count_results_t);
            $new_json->createJsonFile('json/applications.json', $json_array);
        }
        catch (Exception $e)
        {
            echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
        }
    }


}