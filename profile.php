<?php
session_start();
/* if ((!isset($_SESSION['logged_in'])) || ($_SESSION['logged_in'] == false))
{
    header('Location: index.php');
    exit();
}*/

// set connection with db
require_once "php/connect.php";
require_once "php/Profile.php";

$profileInstance = new Profile();

mysqli_report(MYSQLI_REPORT_STRICT);
try
{
    $connection = new mysqli($host, $db_user, $db_pass, $db_name);
    if ($connection->connect_errno != 0)
    {
        throw new Exception(mysqli_connect_errno());
    } else
    {
        // table 1
        $table_personal_data = $connection->query("SELECT u.name, u.surname, a.phone, c.locality As residence_city from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city where u.id_user = '{$_SESSION['id_user']}'");
        if (!$table_personal_data)
        {
            throw new Exception($connection->error);
        }
        $assoc_tpd = $table_personal_data->fetch_assoc();

        // table 2
        $table_experience = $connection->query("SELECT e.job, e.employer, e.start_job, e.end_job, c.locality As job_city, e.description As job_description from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join experiences e on a.id_applicants = e.id_applicants where u.id_user='{$_SESSION['id_user']}'");
        if (!$table_experience)
        {
            throw new Exception($connection->error);
        }
        $count_tx = $table_experience->num_rows;
        $assoc_tx = $table_experience->fetch_assoc();

        // table 3
        $table_education = $connection->query("SELECT s.name_school, s.specialization, s.start_learning, s.end_learning, c.locality As school_city, s.description As school_description from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join schools s on a.id_applicants=s.id_applicants where u.id_user='{$_SESSION['id_user']}'");
        if (!$table_education)
        {
            throw new Exception($connection->error);
        }
        $count_te = $table_education->num_rows;
        $assoc_te = $table_education->fetch_assoc();

        // table 4.1
        $table_lang = $connection->query("SELECT la.language, le.level FROM users u join applicants a on u.id_user=a.id_user join knowledge k on a.id_applicants=k.id_applicants join levels le on k.id_level=le.id_level JOIN languages la on k.id_language=la.id_language where u.id_user = '{$_SESSION['id_user']}'");
        if (!$table_lang)
        {
            throw new Exception($connection->error);
        }
        $count_tl = $table_lang->num_rows;
        $assoc_tl = $table_lang->fetch_assoc();

        // table 4.2
        $table_skills = $connection->query("SELECT s.sience, le.level FROM users u join applicants a on u.id_user=a.id_user join holders k on a.id_applicants=k.id_applicants join levels le on k.id_level=le.id_level join holders h on le.id_level=h.id_level join skills s on s.id_skill=h.id_skill where u.id_user = '{$_SESSION['id_user']}'");
        if (!$table_skills)
        {
            throw new Exception($connection->error);
        }
        $count_ts = $table_skills->num_rows;
        $assoc_ts = $table_skills->fetch_assoc();

        // table 5
        $table_additional = $connection->query("SELECT cv.description As cv_description, cl.description As cl_description, certifications.descriptions As cert_descriptions, t.training, t.description As course_description from users u join applicants a on u.id_user=a.id_user join cv on a.id_applicants=cv.id_applicants join certifications on a.id_applicants=certifications.id_applicants join training t on a.id_applicants=t.id_applicants join applications ap on a.id_applicants=ap.id_applicants join cl on ap.id_application=cl.id_application where u.id_user='{$_SESSION['id_user']}'");
        if (!$table_additional)
        {
            throw new Exception($connection->error);
        }
        $count_ta = $table_additional->num_rows;
        $assoc_ta = $table_additional->fetch_assoc();
    }

    $connection->close();
}
catch (Exception $e)
{
    echo "Server error! Please try again later. Err: ".$e;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recruitment System - Profile</title>
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <link rel="stylesheet" href="/font/stylesheet.css" type="text/css" charset="utf-8" />
    <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
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
            Your profile
        </div>
        <div class="list-row">
            <div class="title-element">Personal data</div>
            <div class="btn-element">
                <div class="btn-unwrap">
                    <div class="line1"></div>
                    <div class="line2"></div>
                </div>
            </div>
        </div>
        <div class="list-row hide" id="personal-data">
            <div class="element-wrapper">
                <div class="form-row">
                    <label for="first-name">First name</label>
                    <input type="text" name="first-name" value="<?php
                    echo $assoc_tpd['name'];
                    ?>">
                    <div class="underline"></div>
                </div>
                <div class="form-row">
                    <label for="last-name">Last name</label>
                    <input type="text" name="last-name" value="<?php
                    echo $assoc_tpd['surname'];
                    ?>">
                    <div class="underline"></div>
                </div>
                <div class="form-row">
                    <label for="phone-num">Phone number</label>
                    <input type="tel" name="phone-num" value="<?php
                    echo $assoc_tpd['phone'];
                    ?>">
                    <div class="underline"></div>
                </div>
                <div class="form-row">
                    <label for="residence-country">Your country</label>
                    <input type="text" name="residence-country" value="<?php
                    //echo $assoc_tpd['country'];
                    ?>">
                    <div class="underline"></div>
                </div>
                <div class="form-row">
                    <label for="residence-city">Your city</label>
                    <input type="text" name="residence-city" value="<?php
                    echo $assoc_tpd['residence_city'];
                    ?>">
                    <div class="underline"></div>
                </div>
            </div>
        </div>
        <?php
        $profileInstance->displayExperience();
        $profileInstance->displayEducation();
        $profileInstance->displaySkills($count_tl, $count_ts, $assoc_tl, $assoc_ts);
        $profileInstance->displayAdditional();
        // Porwałem twoje divy
        // i nie oddam
        ?>
    </div>
</body>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<script src="script/main.js"></script>
<script src="script/burger.js"></script>
<script src="script/calendar.js"></script>
<script src="script/sign-up.js"></script>
<script src="script/profile.js"></script>
</html>