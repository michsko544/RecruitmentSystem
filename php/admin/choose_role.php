<?php
session_start();
$role = $_GET['role'];
switch ($role){
    case "applicant":
        $login = 'admin-applicant';
        $password = 'qwert123';
        break;
    case "recruiter":
        $login = 'admin-recruiter';
        $password = 'qwert123';
        break;
    case "manager":
        $login = 'admin-manager';
        $password = 'qwert123';
        break;
    case "assistant":
        $login = 'admin-assistant';
        $password = 'qwert123';
        break;
    default:
        $login = null;
        $password = null;
        break;
}
if (($login == null) || ($password == null))
{
    header('Location: /admin_pick_role.php');
    exit();
}

require_once "../connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);
try
{
    $connection = new mysqli($host, $db_user, $db_pass, $db_name);
    if ($connection->connect_errno!=0)
    {
        throw new Exception(mysqli_connect_errno());
    }
    else
    {
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");

        if ($result_login = $connection->query(
            sprintf("SELECT * FROM users WHERE login='%s'",
                mysqli_real_escape_string($connection, $login))))
        {
            $user_count = $result_login->num_rows;
            if ($user_count == 1)
            {
                $row_users = $result_login->fetch_assoc();

                if (password_verify($password, $row_users['pass']))
                {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['id_user'] = $row_users['id_user'];
                    $_SESSION['id_role'] = $row_users['id_role'];
                    $_SESSION['first_name'] = $row_users['name'];
                    $_SESSION['last_name'] = $row_users['surname'];
                    $_SESSION['username'] = $row_users['login'];
                    $_SESSION['id_conv'] = $row_users['id_conv'];

                    unset($_SESSION['error']);
                    $result_login->free();
                    $role = $_SESSION['id_role'];
                    switch ($role){
                        case 1:
                            header('Location: /admin_main.php?role=admin');
                            break;
                        case 2:
                            header('Location: /profile.php?role=applicant');
                            break;
                        case 3:
                            header('Location: /applications.php?role=recruiter');
                            break;
                        case 4:
                            header('Location: /applications.php?role=manager');
                            break;
                        case 5:
                            header('Location: /applications.php?role=assistant');
                            break;
                    }
                }
                else
                {
                    $_SESSION['error'] = '<div class="errorLogIn"> Incorrect username or password! </div>';
                    $_SESSION['wrong-input'] = true;
                    header('Location: /index.php?login=wrong');
                    //unset($_SESSION['wrong-input']);
                }
            }
            else
            {
                $_SESSION['error'] = '<div class="errorLogIn"> Incorrect username or password! </div>';
                $_SESSION['wrong-input'] = true;
                header('Location: /index.php?login=wrong');
                //unset($_SESSION['wrong-input']);
            }
        }
        else
        {
            throw new Exception($connection->error);
        }
        $connection->close();
    }
}
catch (Exception $e)
{
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/php/addError.php");
    addError($e);
    echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
}