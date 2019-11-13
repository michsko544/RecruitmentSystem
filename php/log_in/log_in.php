<?php
session_start();

if ((!isset($_POST['username'])) || (!isset($_POST['password'])))
{
    header('Location: index.php');
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
        $login = $_POST['username'];
        $password = $_POST['password'];

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        // $password = htmlentities($password, ENT_QUOTES, "UTF-8");

        if ($result_login = $connection->query(
            sprintf("SELECT * FROM Users WHERE username='%s'",
                mysqli_real_escape_string($connection, $login))))
        {
            $user_count = $result_login->num_rows;
            if ($user_count == 1)
            {
                $row_users = $result_login->fetch_assoc();

                if (password_verify($password, $row_users['password']))
                {

                    $_SESSION['logged_in'] = true;

                    $_SESSION['user_id'] = $row_users['user_id'];
                    $_SESSION['role_id'] = $row_users['role_id'];
                    $_SESSION['first_name'] = $row_users['first_name'];
                    $_SESSION['last_name'] = $row_users['last_name'];
                    $_SESSION['username'] = $row_users['username'];
                    $_SESSION['recruit_id'] = $row_users['recruit_id'];

                    // clear memory
                    unset($_SESSION['error']);
                    $result_login->free();

                    // redirect to user's account considering role
                    $user_role = $row_users['role_id'];
                    if ($result_role = $connection->query(
                        sprintf("SELECT * FROM Roles WHERE role_id='%s'",
                            $user_role))) {
                        // which role
                        $row_roles = $result_role->fetch_assoc();
                        $_SESSION['role_name'] = $row_roles['role_name'];
                        if ($row_roles['role_name'] == 'recruit') {
                            $result_role->free(); // clear memory
                            header('Location: accounts/recruit_account.php');
                        } elseif ($row_roles['role_name'] == 'manager') {
                            $result_role->free(); // clear memory
                            header('Location: accounts/manager_account.php');
                        } elseif ($row_roles['role_name'] == 'assistant') {
                            $result_role->free(); // clear memory
                            header('Location: accounts/assistant_account.php');
                        } elseif ($row_roles['role_name'] == 'recruiter') {
                            $result_role->free(); // clear memory
                            header('Location: accounts/recruiter_account.php');
                        } elseif ($row_roles['role_name'] == 'admin') {
                            $result_role->free(); // clear memory
                            header('Location: accounts/admin_panel.php');
                        } else {
                            $_SESSION['error'] = '<span> Internal error </span>';
                        }
                    }
                    else{
                        throw new Exception($connection->error);
                    }
                }
                else
                {
                    $_SESSION['error'] = '<span> Incorrect username or password </span>';
                    header('Location: index.php');
                }
            }
            else
            {
                $_SESSION['error'] = '<span> Incorrect username or password </span>';
                header('Location: index.php');
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
    echo 'Server error! Try again later';
}

?>