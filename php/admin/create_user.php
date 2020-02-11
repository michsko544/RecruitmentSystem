<?php

function notGood($err_name, $err_message, $inst)
{
    $inst->setFlag(false);
    $_SESSION["$err_name"] = $err_message;
    header("Location: /admin_create_user.php");
}

if (isset($_POST['login'])){
    require_once "../FormsValidation.php";
    require_once "../connect.php";
    $inst = new FormsValidation(true);
    $username = $_POST['login'];
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $password_one = $_POST['password-one'];
    $password_two = $_POST['password-two'];
    $role = $_POST['role'];


    if ((strlen($username) < 3) || (strlen($username) > 20))
    {
        notGood('err_username', 'Username must have more than 3 and less than 20 characters', $inst);
    }
    if (!preg_match('/^[a-z0-9\040.\-]+$/i', $username))
    {
        notGood('err_username', 'Username must contain only letters and numbers', $inst);
    }

    // Validate password

    if ((strlen($password_one) < 8) || (strlen($password_one) > 30))
    {
        notGood('err_password', 'Password must have more than 8 and less than 30 characters', $inst);
    }
    if ($password_one != $password_two)
    {
        notGood('err_password', 'Passwords are not identical', $inst);
    }
    $hashed_password = password_hash($password_one, PASSWORD_DEFAULT);

    if (!preg_match('/^[a-z\040.\-]+$/i', $first_name))
    {
        notGood('err_first_name', 'First name may contain only letters', $inst);
    }

    //Validate last name

    if (!preg_match('/^[a-z\040.\-]+$/i', $last_name))
    {
        notGood('err_last_name', 'Last name may contain only letters', $inst);
    }

    try
    {
        $connection = new mysqli($host, $db_user, $db_pass, $db_name);
        if ($connection->connect_errno != 0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            // Validate username uniqueness
            $result_username = $connection->query("SELECT id_user FROM users WHERE login='$username'");
            if (!$result_username)
            {
                throw new Exception($connection->error);
            }
            $count_input = $result_username->num_rows;
            if ($count_input > 0)
            {
                notGood('err_username', 'Unavailable username', $inst);
            }
            // Validate position with db
            $result_role = $connection->query("SELECT id_role FROM roles WHERE name_role = '{$role}'");
            if (!$result_role)
            {
                throw new Exception($connection->error);
            }
            else
            {
                $count_input = $result_role->num_rows;
                if ($count_input != 1)
                {
                    notGood('err_role', 'Role currently unavailable', $inst);
                }
                $role_table = $result_role->fetch_assoc();
                $role_id = $role_table['id_role'];
                }
            }

            if ($inst->checkFlag() == true)
            {
                $timestamp = date("Y-m-d");
                if ($connection->query("insert into users (id_user, login, name, surname, pass, id_role, date) values (null, '{$username}', '{$first_name}', '{$last_name}', '{$hashed_password}', {$role_id}, '{$timestamp}')")){
                    header("Location: /admin_manage_users.php?aU=success");
                } else {
                    throw new Exception($connection->error);
                }
            }
            $connection->close();
        }
    catch(Exception $e)
    {
        require_once ($_SERVER['DOCUMENT_ROOT'] . "/php/addError.php");
        addError($e);
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
    }
}
