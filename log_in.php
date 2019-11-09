<?php
session_start();

if ((!isset($_POST['username'])) || (!isset($_POST['password'])))
{
    header('Location: index.php');
    exit();
}

require_once "connect.php";

$connection = @new mysqli($host, $db_user, $db_pass, $db_name);

if ($connection->connect_errno!=0)
{
   echo "Error: ".$connection->connect_errno;
}
else
{
    $login = $_POST['username'];
    $password = $_POST['password'];

    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    $password = htmlentities($password, ENT_QUOTES, "UTF-8");

    if ($result_login = @$connection->query(sprintf("SELECT * FROM Users WHERE username='%s' AND pass='%s'",
        mysqli_real_escape_string($connection, $login),
        mysqli_real_escape_string($connection, $password))))
    {
        $user_count = $result_login->num_rows;
        if ($user_count == 1)
        {
            $_SESSION['logged_in'] = true;

            $row_users = $result_login->fetch_assoc();

            $_SESSION['user_id'] = $row_users['user_id'];
            $_SESSION['first_name'] = $row_users['first_name'];
            $_SESSION['last_name'] = $row_users['last_name'];
            $_SESSION['username'] = $row_users['username'];
            $_SESSION['recruit_id'] = $row_users['recruit_id'];

            // clear memory
            unset($_SESSION['error']);
            $result_login->free();

            // redirect to user's account considering role
            $user_role = $row_users['role_id'];
            if ($result_role = @$connection->query(sprintf("SELECT * FROM Roles WHERE role_id='%s'",
            $user_role)))
            {
                // which role
                $row_roles = $result_role->fetch_assoc();
                if ($row_roles['role_name'] == 'recruit')
                {
                    $result_role->free(); // clear memory
                    header('Location: recruit_account.php');
                }
                elseif ($row_roles['role_name'] == 'manager')
                {
                    $result_role->free(); // clear memory
                    header('Location: manager_account.php');
                }
                elseif ($row_roles['role_name'] == 'assistant')
                {
                    $result_role->free(); // clear memory
                    header('Location: assistant_account.php');
                }
                elseif ($row_roles['role_name'] == 'recruiter')
                {
                    $result_role->free(); // clear memory
                    header('Location: recruiter_account.php');
                }
                elseif ($row_roles['role_name'] == 'admin')
                {
                    $result_role->free(); // clear memory
                    header('Location: admin_panel.php');
                }
                else
                {
                    $_SESSION['error'] = '<span> Internal error </span>';
                }
            }
        }
        else
        {
            $_SESSION['error'] = '<span> Incorrect username or password </span>';
            header('Location: index.php');
        }
    }
    $connection->close();
}
?>