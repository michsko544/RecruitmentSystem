<?php
   session_start();
   /*if ((!isset($_SESSION['logged_in'])) || ($_SESSION['logged_in'] == false))
   {
        header('Location: index.php');
        exit();
   }*/
   ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recruitment System - Applications</title>
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <link rel="stylesheet" href="/font/stylesheet.css" type="text/css" charset="utf-8" />
</head>
<body>
    <nav>
        <div class="nav-bar">
            <div class="logo-nav">myCompany</div>
            <ul class="nav-links">
                <li id="menu">Menu</li>
                <li><a href="profile.php">My profile</a></li>
                <li><a href="applications.php">Applications</a></li>
                <li><a href="#">Replies</a></li>
                <li><a href="php/log_in/log_out.php">Sign out</a></li>
            </ul>
            <div id="btn-burger" class="btn-nav">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
        </div>
        <div id="nav-help"></div>
    </nav>
    <div id="container">
        <div class="small-title">
            Application status
        </div>
        <div class="list-row">

            <?php
            require_once "php/connect.php";
            require_once "php/HandleJson.php";

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
                $count_results_idc = $new_json->fetchData($query_idc, $data_push_idc, $json_array['applications']['id_conv'], $host, $db_user, $db_pass, $db_name);
                $count_results_t = $new_json->fetchData($query_t, $data_push_t, $json_array['applications']['conv_topic'], $host, $db_user, $db_pass, $db_name);
                $new_json->addCounters($json_array['counters']['name'], $count_results_n);
                $new_json->addCounters($json_array['counters']['position'], $count_results_p);
                $new_json->addCounters($json_array['counters']['description'], $count_results_d);
                $new_json->addCounters($json_array['counters']['status'], $count_results_ns);
                $new_json->addCounters($json_array['counters']['id-conv'], $count_results_idc);
                $new_json->addCounters($json_array['counters']['conv-topic'], $count_results_t);
                $new_json->createJsonFile('json/applications.json', $json_array);
            }
            catch (Exception $e)
            {
                echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
            }
            ?>

            <div class="position first-text">Front-end Developer</div>
            <div class="app-status-sent last-text">Application sent</div>
        </div>
        <div class="list-row" id="personal-data">
            <div class="position first-text">.NET C# Developer</div>
            <div class="app-status-opened last-text">Application has been opened</div>
        </div>
        <div class="list-row">
            <div class="position first-text">C/C++ Controllers Programmer</div>
            <div class="app-status-replied last-text">Recruiter contacted you. <a href="#">Check your replies!</a></div>
        </div>
        
    </div>
</body>

<script src="script/main.js"></script>
<script src="script/burger.js"></script>

</html>