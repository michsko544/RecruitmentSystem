<?php
session_start();
require_once "SignUpSystem.php";

//Form 1
if (isset($_POST['e-mail']))
{
    $sign_up_class = new SignUpSystem(true);


    // Validate username
    $username = $_POST['login'];
    if ((strlen($username) < 3) || (strlen($username) > 20))
    {
        $sign_up_class->notGood('err_username', 'Username must have more than 3 and less than 20 characters');
    }
    if (ctype_alnum($username) == false)
    {
        $sign_up_class->notGood('err_username', 'Username must contain only letters and numbers');
    }

    // Validate e-mail
    $email = $_POST['e-mail'];
    $sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ((filter_var($sanitized_email, FILTER_VALIDATE_EMAIL) == false) || ($sanitized_email != $email))
    {
        $sign_up_class->notGood('err_email', 'Incorrect e-mail address');
    }

    // Validate password
    $password_one = $_POST['password-one'];
    $password_two = $_POST['password-two'];
    if ((strlen($password_one) < 8) || (strlen($password_one) > 30))
    {
        $sign_up_class->notGood('err_password', 'Password must have more than 8 and less than 30 characters');
    }
    if ($password_one != $password_two)
    {
        $sign_up_class->notGood('err_password', 'Passwords are not identical');
    }
    $hashed_password = password_hash($password_one, PASSWORD_DEFAULT);

    // Validate terms of use
    if (!isset($_POST['terms-of-use']))
    {
        $sign_up_class->notGood('err_terms', 'You must accept our Terms of Use and Privacy Policy');
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
                $sign_up_class->notGood('err_email', 'Unavailable e-mail address');
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
                $sign_up_class->notGood('err_username', 'Unavailable username');
            }

            if ($sign_up_class->checkFlag() == true)
            {
                // Add to session variables and wait for other steps
               // $_SESSION['insert_username'] = $username;
               // $_SESSION['insert_email'] = $email;
               // $_SESSION['insert_password'] = $hashed_password;

                // Add to array and wait
                $sign_up_class->setInsertValue('username', $username);
                $sign_up_class->setInsertValue('email', $email);
                $sign_up_class->setInsertValue('password', $hashed_password);
            }
            $connection->close();

        }
    }
    catch(Exception $e)
    {
        echo 'Server error! Try signing up later';
    }
    // Unset remembered values
    if (isset($_SESSION['rem_username'])) unset($_SESSION['rem_username']);
    if (isset($_SESSION['rem_email'])) unset($_SESSION['rem_email']);
    if (isset($_SESSION['rem_password_one'])) unset($_SESSION['rem_password_one']);
    if (isset($_SESSION['rem_password_two'])) unset($_SESSION['rem_password_two']);
    if (isset($_SESSION['rem_terms'])) unset($_SESSION['rem_terms']);
    // Unset error values
    if (isset($_SESSION['err_username'])) unset($_SESSION['err_username']);
    if (isset($_SESSION['err_email'])) unset($_SESSION['err_email']);
    if (isset($_SESSION['err_password_one'])) unset($_SESSION['err_password_one']);
    if (isset($_SESSION['err_password_two'])) unset($_SESSION['err_password_two']);
    if (isset($_SESSION['err_terms'])) unset($_SESSION['err_terms']);
}

//Form 2
if (isset($_POST['first-name']))
{
    // Validate first name
    $first_name = $_POST['first-name'];
    if (ctype_alpha($first_name) == false)
    {
        $sign_up_class->notGood('err_first_name', 'First name may contain only letters');
    }

    //Validate last name
    $last_name = $_POST['last-name'];
    if (ctype_alpha($last_name) == false)
    {
        $sign_up_class->notGood('err_last_name', 'Last name may contain only letters');
    }

    //Validate phone number
    $phone = $_POST['phone-num'];
    if (ctype_digit($phone) == false)
    {
        $sign_up_class->notGood('err_phone', 'Phone number may contain only numbers');
    }
    if (strlen($phone) != 9)
    {
        $sign_up_class->notGood('err_phone', 'Phone number must be 9 digits long');
    }

    //Validate country
    $residence_country = $_POST['residence-country'];
    if (ctype_alpha($residence_country) == false)
    {
        $sign_up_class->notGood('err_residence_country', 'Country name may contain only letters');
    }
    //TODO add country list (from db)

    //Validate city
    $residence_city = $_POST['residence-city'];
    if (ctype_alpha($residence_city) == false)
    {
        $sign_up_class->notGood('err_residence_city', 'City name may contain only letters');
    }
    
    // Remember value
    $_SESSION['rem_first_name'] = $first_name;
    $_SESSION['rem_last_name'] = $last_name;
    $_SESSION['rem_phone'] = $phone;
    $_SESSION['rem_residence_country'] = $residence_country;
    $_SESSION['rem_residence_city'] = $residence_city;

    try
    {
        $connection = new mysqli($host, $db_user, $db_pass, $db_name);
        if ($connection->connect_errno != 0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            if ($sign_up_class->checkFlag() == true)
            {
                // Add to session variables and wait for other steps
               // $_SESSION['insert_first_name'] = $first_name;
               // $_SESSION['insert_last_name'] = $last_name;
               // $_SESSION['insert_phone'] = $phone;
               // $_SESSION['insert_residence_country'] = $residence_country;
               // $_SESSION['insert_residence_city'] = $residence_city;

                //Add to array and wait
                $sign_up_class->setInsertValue('first_name', $first_name);
                $sign_up_class->setInsertValue('last_name', $last_name);
                $sign_up_class->setInsertValue('phone', $phone);
                $sign_up_class->setInsertValue('residence_country', $residence_country);
                $sign_up_class->setInsertValue('residence_city', $residence_city);
            }
            $connection->close();
        }
    }
    catch(Exception $e)
    {
        echo 'Server error! Try signing up later';
    }

    // Unset remembered values
    if (isset($_SESSION['rem_first_name'])) unset($_SESSION['rem_first_name']);
    if (isset($_SESSION['rem_last_name'])) unset($_SESSION['rem_last_name']);
    if (isset($_SESSION['rem_phone'])) unset($_SESSION['rem_phone']);
    if (isset($_SESSION['rem_residence_country'])) unset($_SESSION['rem_residence_country']);
    if (isset($_SESSION['rem_residence_city'])) unset($_SESSION['rem_residence_city']);
    // Unset error values
    if (isset($_SESSION['err_first_name'])) unset($_SESSION['err_first_name']);
    if (isset($_SESSION['err_last_name'])) unset($_SESSION['err_last_name']);
    if (isset($_SESSION['err_phone'])) unset($_SESSION['err_phone']);
    if (isset($_SESSION['err_residence_country'])) unset($_SESSION['err_residence_country']);
    if (isset($_SESSION['err_residence_city'])) unset($_SESSION['err_residence_city']);
}

//Form 3


// TODO unset insert values

unset($sign_up_class);