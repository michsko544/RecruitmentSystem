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
            $pos_name = "";
            $connection = new mysqli($host, $db_user, $db_pass, $db_name);
            try
            {
                if ($connection->connect_errno != 0)
                {
                    throw new Exception(mysqli_connect_errno());
                }
                else
                {
                    $user_app_join = $connection->query("SELECT id_applicants FROM applicants WHERE id_user = '{$_SESSION['id_user']}'");
                    if (!$user_app_join)
                    {
                        throw new Exception($connection->error);
                    }
                    else
                    {
                        $id_from_user = $user_app_join->fetch_assoc();
                        $user_id_select = $id_from_user['id_applicants'];
                    }


                    $application_name = $connection->query("SELECT * FROM applications WHERE id_applicants = '$user_id_select'");
                    if (!$application_name)
                    {
                        // TODO wypisac liste zlozonych aplikacji i ich statusy
                        throw new Exception($connection->error);
                    }
                    else
                    {
                        $pos_name = $application_name;

                        // free mem
                        $application_name->free();
                    }
                }
            }
            catch (Exception $e)
            {
                echo 'Server error! Try signing up later';
            }
            $connection->close();
            foreach ($pos_name as $key=>$value)
            {
                echo '<option value="'.$value.'">'.$value.' </option>';
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