<?php
session_start();

function notGood($err_name, $err_message)
{
    $correct_data = false;
    $_SESSION["$err_name"] = $err_message;
}

if (isset($_POST['e-mail']))
{
    $correct_data = true;

    // Validate username
    $username = $_POST['login'];
    if ((strlen($username) < 3) || (strlen($username) > 20))
    {
        notGood('err_username', 'Username must have more than 3 and less than 20 characters');
    }
    if (ctype_alnum($username) == false)
    {
        notGood('err_username', 'Username must contain only letters and numbers');
    }

    // Validate e-mail
    $email = $_POST['e-mail'];
    $sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ((filter_var($sanitized_email, FILTER_VALIDATE_EMAIL) == false) || ($sanitized_email != $email))
    {
        notGood('err_email', 'Incorrect e-mail address');
    }

    // Validate password
    $password_one = $_POST['password-one'];
    $password_two = $_POST['password-two'];
    if ((strlen($password_one) < 8) || (strlen($password_one) > 30))
    {
        notGood('err_password', 'Password must have more than 8 and less than 30 characters');
    }
    if ($password_one != $password_two)
    {
        notGood('err_password', 'Passwords are not identical');
    }
    $hashed_password = password_hash($password_one, PASSWORD_DEFAULT);

    // Validate terms of use
    if (!isset($_POST['terms-of-use']))
    {
        notGood('err_terms', 'You must accept our Terms of Use and Privacy Policy');
    }

    // Validate CAPTCHA TODO add reCAPTCHA

    // Remember value
    $_SESSION['rem_username'] = $username;
    $_SESSION['rem_email'] = $email;
    $_SESSION['rem_password_one'] = $password_one;
    $_SESSION['rem_password_two'] = $password_two;
    if (isset($_POST['terms-of-use']))
    {
        $_SESSION['rem_terms'] = true;
    }

    // DB connection
    require_once "../connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try
    {
        $connection = new mysqli($host, $db_user, $db_pass, $db_name);
        if ($connection->connect_errno != 0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            // Validate email uniqueness
            $result_email = $connection->query("SELECT id_user FROM Users WHERE email='$email'");
            if (!$result_email)
            {
                throw new Exception($connection->error);
            }
            $count_input = $result_email->num_rows;
            if ($count_input > 0)
            {
                notGood('err_email', 'Unavailable e-mail address');
            }
            // Validate username uniqueness
            $result_username = $connection->query("SELECT id_user FROM Users WHERE username='$username'");
            if (!$result_username)
            {
                throw new Exception($connection->error);
            }
            $count_input = $result_username->num_rows;
            if ($count_input > 0)
            {
                notGood('err_username', 'Unavailable username');
            }

            if ($correct_data == true)
            {
                // Add to session variables and wait for other steps
                $_SESSION['insert_username'] = $username;
                $_SESSION['insert_email'] = $email;
                $_SESSION['insert_password'] = $hashed_password;
            }
            $connection->close();
        }
    }
    catch(Exception $e)
    {
        echo 'Server error! Try signing up later';
    }
    // TODO add other steps


}