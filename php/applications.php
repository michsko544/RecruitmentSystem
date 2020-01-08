<?php
function getApplicationsData($condition){
    require "connect.php";
    require_once "HandleJson.php";

    $query_e = "SELECT u.id_user from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position WHERE {$condition}";
    $query_n = "SELECT u.name from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position WHERE {$condition}";
    $query_su = "SELECT u.surname from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position WHERE {$condition}";
    $query_p = "SELECT p.position from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position WHERE {$condition}";
    $query_d = "SELECT p.description from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position WHERE {$condition}";
    $query_ns = "SELECT s.name_status from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position WHERE {$condition}";
    $query_st = "SELECT sor.name_stage from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join sor sor on ap.id_application=sor.id_application join positions p on ap.id_position=p.id_position WHERE {$condition}";
    //$query_idc = "SELECT c.id_conv from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position join messages m on u.id_user=u.id_user join conv c on m.id_conv=c.id_conv WHERE {$condition}";
    //$query_t = "SELECT c.topic from users u join applicants a on u.id_user=a.id_user join applications ap on a.id_applicants=ap.id_applicants join statuses s on ap.id_status=s.id_status join positions p on ap.id_position=p.id_position join messages m on u.id_user=u.id_user join conv c on m.id_conv=c.id_conv WHERE {$condition}";
    $data_push_e = array(); $data_push_n = array(); $data_push_su = array(); $data_push_p = array(); $data_push_d = array(); $data_push_ns = array(); $data_push_st = array(); //$data_push_idc = array(); $data_push_t = array();
    $json_array = array();

    $new_json = new HandleJson();
    mysqli_report(MYSQLI_REPORT_STRICT);
    try
    {
        $count_results_e = $new_json->fetchData($query_e, $data_push_e, $json_array['applications']['personalData']['idUser'], $host, $db_user, $db_pass, $db_name);
        $count_results_n = $new_json->fetchData($query_n, $data_push_n, $json_array['applications']['personalData']['name'], $host, $db_user, $db_pass, $db_name);
        $count_results_su = $new_json->fetchData($query_su, $data_push_su, $json_array['applications']['personalData']['surname'], $host, $db_user, $db_pass, $db_name);
        $count_results_p = $new_json->fetchData($query_p, $data_push_p, $json_array['applications']['position'], $host, $db_user, $db_pass, $db_name);
        $count_results_d = $new_json->fetchData($query_d, $data_push_d, $json_array['applications']['description'], $host, $db_user, $db_pass, $db_name);
        $count_results_ns = $new_json->fetchData($query_ns, $data_push_ns, $json_array['applications']['status'], $host, $db_user, $db_pass, $db_name);
        $count_results_st = $new_json->fetchData($query_st, $data_push_st, $json_array['applications']['stage'], $host, $db_user, $db_pass, $db_name);
        //$count_results_idc = $new_json->fetchData($query_idc, $data_push_idc, $json_array['applications']['idConv'], $host, $db_user, $db_pass, $db_name);
        //$count_results_t = $new_json->fetchData($query_t, $data_push_t, $json_array['applications']['convTopic'], $host, $db_user, $db_pass, $db_name);
        $new_json->addCounters($json_array['counters']['name'], $count_results_n);
        $new_json->addCounters($json_array['counters']['position'], $count_results_p);
        $new_json->addCounters($json_array['counters']['description'], $count_results_d);
        $new_json->addCounters($json_array['counters']['status'], $count_results_ns);
        //$new_json->addCounters($json_array['counters']['idConv'], $count_results_idc);
        //$new_json->addCounters($json_array['counters']['convTopic'], $count_results_t);
        $new_json->createJsonFile('json/applications.json', $json_array);
    }
    catch (Exception $e)
    {
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
    }
}

if (isset($_POST['position'])) {
    $position = $_POST['position'];
    $cover_letter = $_FILES['cover-letter']; // TODO nie dziala
    echo $cover_letter;
    /*if (isset($_FILES['cover-letter'])) {
        $uploads_dir = '../uploads';
        echo $_FILES['cover-letter']['error'];
        foreach ($_FILES["cover-letter"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["cover-letter"]["tmp_name"][$key];
                // basename() may prevent filesystem traversal attacks;
                // further validation/sanitation of the filename may be appropriate
                $name = basename($_FILES["cover-letter"]["name"][$key]);
                move_uploaded_file($tmp_name, "$uploads_dir/$name");
                $connection = @new mysqli($host, $db_user, $db_pass, $db_name);
                $id_app_query = $connection->query("select id_application from applications");
                $id_app = $id_app_query->num_rows + 1;
                $id_app_user_query = $connection->query("select id_applicants from applicants where id_user = '{$_SESSION['id_user']}'");
                $id_app_user_table = $id_app_user_query->fetch_assoc();
                $id_appuser = $id_app_user_table['id_applicants'];
                $id_position_query = $connection->query("select id_position from positions where position = '{$position}'");
                $id_pos_table = $id_position_query->fetch_assoc();
                $id_position = $id_pos_table['id_position'];
                $ret = $connection->query("insert into cl (id_cl, description, id_application) values (null, 'uploads/{$name}', {$id_app})");
                $id_cl_query = $connection->query("select id_cl from cl");
                $id_cl = $id_cl_query->num_rows;
                $ret = $connection->query("insert into applications (id_application, id_applicants, id_decision, id_position, id_status, id_cl) values (null, {$id_appuser}, 3, {$id_position}, 1, {$id_cl})");
                echo 'bangla';
            }
        }
    }*/
}