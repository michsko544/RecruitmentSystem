<?php
function getProfileData($user){
    require "connect.php";
    require_once "HandleJson.php";


// array from DB
    $json_array = array();

// tmp array
    $data_push_temail = array();
    $data_push_tpdn = array(); $data_push_tpds = array(); $data_push_tpdp = array(); $data_push_tpdc = array(); $data_push_tpdl = array();
    $data_push_txj = array(); $data_push_txe = array(); $data_push_txsj = array(); $data_push_txej = array(); $data_push_txc = array(); $data_push_txd = array();
    $data_push_ten = array(); $data_push_tes = array(); $data_push_tesl = array(); $data_push_teel = array(); $data_push_tec = array(); $data_push_ted = array();
    $data_push_tl = array(); $data_push_tll = array();
    $data_push_ts = array(); $data_push_tsl = array();
    $data_push_tcv = array();
    $data_push_tcl = array();
    $data_push_tce = array();
    $data_push_tco = array();

// queries
    $query_temail = "SELECT a.email from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join countries co on a.id_country=co.id_country where u.id_user = '{$user}'";
    $query_tpdn = "SELECT u.name from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join countries co on a.id_country=co.id_country where u.id_user = '{$user}'";
    $query_tpds = "SELECT u.surname from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join countries co on a.id_country=co.id_country where u.id_user = '{$user}'";
    $query_tpdp = "SELECT a.phone from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join countries co on a.id_country=co.id_country where u.id_user = '{$user}'";
    $query_tpdc = "SELECT co.country from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join countries co on a.id_country=co.id_country where u.id_user = '{$user}'";
    $query_tpdl = "SELECT c.locality As residence_city from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join countries co on a.id_country=co.id_country where u.id_user = '{$user}'";
    $query_txj = "SELECT e.job from users u join applicants a on u.id_user=a.id_user join experiences e on a.id_applicants = e.id_applicants join cities c on e.id_city=c.id_city where u.id_user='{$user}'";
    $query_txe = "SELECT e.employer from users u join applicants a on u.id_user=a.id_user join experiences e on a.id_applicants = e.id_applicants join cities c on e.id_city=c.id_city where u.id_user='{$user}'";
    $query_txsj = "SELECT e.start_job from users u join applicants a on u.id_user=a.id_user join experiences e on a.id_applicants = e.id_applicants join cities c on e.id_city=c.id_city where u.id_user='{$user}'";
    $query_txej = "SELECT e.end_job from users u join applicants a on u.id_user=a.id_user join experiences e on a.id_applicants = e.id_applicants join cities c on e.id_city=c.id_city where u.id_user='{$user}'";
    $query_txc = "SELECT c.locality As job_city from users u join applicants a on u.id_user=a.id_user join experiences e on a.id_applicants = e.id_applicants join cities c on e.id_city=c.id_city where u.id_user='{$user}'";
    $query_txd = "SELECT e.description As job_description from users u join applicants a on u.id_user=a.id_user join experiences e on a.id_applicants = e.id_applicants join cities c on e.id_city=c.id_city where u.id_user='{$user}'";
    $query_ten = "SELECT s.name_school from users u join applicants a on u.id_user=a.id_user join schools s on a.id_applicants=s.id_applicants join cities c on s.id_city=c.id_city where u.id_user='{$user}'";
    $query_tes = "SELECT s.specialization from users u join applicants a on u.id_user=a.id_user join schools s on a.id_applicants=s.id_applicants join cities c on s.id_city=c.id_city where u.id_user='{$user}'";
    $query_tesl = "SELECT s.start_learning from users u join applicants a on u.id_user=a.id_user join schools s on a.id_applicants=s.id_applicants join cities c on s.id_city=c.id_city where u.id_user='{$user}'";
    $query_teel = "SELECT s.end_learning from users u join applicants a on u.id_user=a.id_user join schools s on a.id_applicants=s.id_applicants join cities c on s.id_city=c.id_city where u.id_user='{$user}'";
    $query_tec = "SELECT c.locality As school_city from users u join applicants a on u.id_user=a.id_user join schools s on a.id_applicants=s.id_applicants join cities c on s.id_city=c.id_city where u.id_user='{$user}'";
    $query_ted = "SELECT s.description As school_description from users u join applicants a on u.id_user=a.id_user join schools s on a.id_applicants=s.id_applicants join cities c on s.id_city=c.id_city where u.id_user='{$user}'";
    $query_tl = "SELECT la.language from users u join applicants a on u.id_user=a.id_user join knowledge k on a.id_applicants=k.id_applicants join languages la on k.id_language=la.id_language where u.id_user = '{$user}'";
    $query_tll = "SELECT le.id_level from users u join applicants a on u.id_user=a.id_user join knowledge k on a.id_applicants=k.id_applicants join levels le on k.id_level=le.id_level join languages la on k.id_language=la.id_language where u.id_user = '{$user}'";
    $query_ts = "SELECT s.sience from users u join applicants a on u.id_user=a.id_user join holders k on a.id_applicants=k.id_applicants join skills s on s.id_skill=k.id_skill where u.id_user = '{$user}'";
    $query_tsl = "SELECT le.id_level from users u join applicants a on u.id_user=a.id_user join holders k on a.id_applicants=k.id_applicants join levels le on k.id_level=le.id_level join skills s on s.id_skill=k.id_skill where u.id_user = '{$user}'";
    $query_tcv = "SELECT cv.description As cv_description from users u join applicants a on u.id_user=a.id_user join cv on a.id_applicants=cv.id_applicants join certifications on a.id_applicants=certifications.id_applicants join training t on a.id_applicants=t.id_applicants join applications ap on a.id_applicants=ap.id_applicants join cl on ap.id_application=cl.id_application where u.id_user='{$user}'";
    $query_tcl = "SELECT cl.description As cl_description from users u join applicants a on u.id_user=a.id_user join certifications on a.id_applicants=certifications.id_applicants join training t on a.id_applicants=t.id_applicants join applications ap on a.id_applicants=ap.id_applicants join cl on ap.id_application=cl.id_application where u.id_user='{$user}'";
    $query_tce = "SELECT certifications.descriptions As cert_descriptions from users u join applicants a on u.id_user=a.id_user join cv on a.id_applicants=cv.id_applicants join certifications on a.id_applicants=certifications.id_applicants join training t on a.id_applicants=t.id_applicants join applications ap on a.id_applicants=ap.id_applicants join cl on ap.id_application=cl.id_application where u.id_user='{$user}'";
    $query_tco = "SELECT t.description As course_description from users u join applicants a on u.id_user=a.id_user join cv on a.id_applicants=cv.id_applicants join certifications on a.id_applicants=certifications.id_applicants join training t on a.id_applicants=t.id_applicants join applications ap on a.id_applicants=ap.id_applicants join cl on ap.id_application=cl.id_application where u.id_user='{$user}'";

    $new_json = new HandleJson();

// connect with db
    mysqli_report(MYSQLI_REPORT_STRICT);
    try
    {
        // add db results to array
        $count_tpd = $new_json->fetchData($query_temail, $data_push_temail, $json_array['email'], $host, $db_user, $db_pass, $db_name);
        $count_tpd = $new_json->fetchData($query_tpdn, $data_push_tpdn, $json_array['personalData']['firstName'], $host, $db_user, $db_pass, $db_name);
        $count_tpd = $new_json->fetchData($query_tpds, $data_push_tpds, $json_array['personalData']['lastName'], $host, $db_user, $db_pass, $db_name);
        $count_tpd = $new_json->fetchData($query_tpdp, $data_push_tpdp, $json_array['personalData']['phone'], $host, $db_user, $db_pass, $db_name);
        $count_tpd = $new_json->fetchData($query_tpdc, $data_push_tpdc, $json_array['personalData']['country'], $host, $db_user, $db_pass, $db_name);
        $count_tpd = $new_json->fetchData($query_tpdl, $data_push_tpdl, $json_array['personalData']['city'], $host, $db_user, $db_pass, $db_name);
        $count_tx = $new_json->fetchData($query_txj, $data_push_txj, $json_array['experience']['jobTitle'], $host, $db_user, $db_pass, $db_name);
        $count_tx = $new_json->fetchData($query_txe, $data_push_txe, $json_array['experience']['employer'], $host, $db_user, $db_pass, $db_name);
        $count_tx = $new_json->fetchData($query_txsj, $data_push_txsj, $json_array['experience']['startDate'], $host, $db_user, $db_pass, $db_name);
        $count_tx = $new_json->fetchData($query_txej, $data_push_txej, $json_array['experience']['endDate'], $host, $db_user, $db_pass, $db_name);
        $count_tx = $new_json->fetchData($query_txc, $data_push_txc, $json_array['experience']['city'], $host, $db_user, $db_pass, $db_name);
        $count_tx = $new_json->fetchData($query_txd, $data_push_txd, $json_array['experience']['description'], $host, $db_user, $db_pass, $db_name);
        $count_te = $new_json->fetchData($query_ten, $data_push_ten, $json_array['education']['schoolName'], $host, $db_user, $db_pass, $db_name);
        $count_te = $new_json->fetchData($query_tes, $data_push_tes, $json_array['education']['specialization'], $host, $db_user, $db_pass, $db_name);
        $count_te = $new_json->fetchData($query_tesl, $data_push_tesl, $json_array['education']['startDate'], $host, $db_user, $db_pass, $db_name);
        $count_te = $new_json->fetchData($query_teel, $data_push_teel, $json_array['education']['endDate'], $host, $db_user, $db_pass, $db_name);
        $count_te = $new_json->fetchData($query_tec, $data_push_tec, $json_array['education']['city'], $host, $db_user, $db_pass, $db_name);
        $count_te = $new_json->fetchData($query_ted, $data_push_ted, $json_array['education']['description'], $host, $db_user, $db_pass, $db_name);
        $count_tl = $new_json->fetchData($query_tl, $data_push_tl, $json_array['skills']['languages']['lang'], $host, $db_user, $db_pass, $db_name);
        $count_tll = $new_json->fetchData($query_tll, $data_push_tll, $json_array['skills']['languages']['level'], $host, $db_user, $db_pass, $db_name);
        $count_ts = $new_json->fetchData($query_ts, $data_push_ts, $json_array['skills']['skills']['skill'], $host, $db_user, $db_pass, $db_name);
        $count_tsl = $new_json->fetchData($query_tsl, $data_push_tsl, $json_array['skills']['skills']['level'], $host, $db_user, $db_pass, $db_name);
        $count_tcv = $new_json->fetchData($query_tcv, $data_push_tcv, $json_array['additional']['cv'], $host, $db_user, $db_pass, $db_name);
        $count_tcl = $new_json->fetchData($query_tcl, $data_push_tcl, $json_array['additional']['coverLetter'], $host, $db_user, $db_pass, $db_name);
        $count_tce = $new_json->fetchData($query_tce, $data_push_tce, $json_array['additional']['certificates'], $host, $db_user, $db_pass, $db_name);
        $count_tco = $new_json->fetchData($query_tco, $data_push_tco, $json_array['additional']['courses'], $host, $db_user, $db_pass, $db_name);

        $new_json->addCounters($json_array['counters']['personalData'], $count_tpd);
        $new_json->addCounters($json_array['counters']['experience'], $count_tx);
        $new_json->addCounters($json_array['counters']['education'], $count_te);
        $new_json->addCounters($json_array['counters']['language'], $count_tl);
        $new_json->addCounters($json_array['counters']['skill'], $count_ts);
        $new_json->addCounters($json_array['counters']['cv'], $count_tcv);
        $new_json->addCounters($json_array['counters']['coverLetter'], $count_tcl);
        $new_json->addCounters($json_array['counters']['certificate'], $count_tce);
        $new_json->addCounters($json_array['counters']['course'], $count_tco);

        //fill .json file with data from db
        $new_json->createJsonFile('json/profile.json', $json_array);
    }
    catch (Exception $e)
    {
        require_once "addError.php";
        addError($e);
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
    }
}

function updateData($id_user){
    // TODO update user's data

}
