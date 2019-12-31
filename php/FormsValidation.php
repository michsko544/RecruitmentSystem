<?php
class FormsValidation
{
    private $correct_data = true;
    private $insert_values = array(
        'username' => '',
        'email' => '',
        'password' => '',
        'position' => '',
    );
    private $insert_personal_data = array(
        'first_name' => '',
        'last_name' => '',
        'phone' => '',
        'residence_country' => '',
        'residence_city' => '',
    );
    private $insert_employment = array(
        'job_title' => array(),
        'employer' => array(),
        'start_date' => array(),
        'end_date' => array(),
        'city' => array(),
        'description' => array(),
    );
    private $insert_skill_language = array(
        'language' => array(),
        'language_level' => array(),
        'skill' => array(),
        'skill_level' => array(),
    );
    private $insert_school = array(
        'school' => array(),
        'specialization' => array(),
        'start_date' => array(),
        'end_date' => array(),
        'city' => array(),
        'description' => array(),
    );
    private $insert_cert_course = array(
        'cv' => array(),
        'cover_letter' => array(),
        'certificate' => array(),
        'course' => array(),
    );

function __construct($flag_status)
{
    $this->correct_data = $flag_status;
}


    // Pick data from DB
function pickDataFromDB($query, $host, $db_user, $db_pass, $db_name)
{
    mysqli_report(MYSQLI_REPORT_STRICT);
    try
    {
    $connection = new mysqli($host, $db_user, $db_pass, $db_name);
    if ($connection->connect_errno != 0) {
        throw new Exception(mysqli_connect_errno());
    } else {
        if ($position_name = $connection->query($query)) {
            while ($pos_name = $position_name->fetch_assoc()) {
                foreach ($pos_name as $key=>$value) {
                    if(isset($_SESSION['rem_position'])){
                        echo '<option selected="'. $_SESSION['rem_position']  .'" value="'.$value.'"> '.$value.' </option>';
                    } else {
                        echo '<option value="'.$value.'" > '.$value.' </option>';
                    }
                }
            }
        } else {
            throw new Exception($connection->error);
        }
        $connection->close();
    }
    }
    catch
    (Exception $e) {
        echo "<div class='server-error'>Server error! Please try again later. Err: " . $e . "</div>";
    }
}

function setInsertValue($column, $value)
{
    $this->insert_values[$column] = $value;
    $_SESSION['array']['val'] = $this->insert_values;
}

function setInsertPersonalData($column, $value)
{
    $this->insert_personal_data[$column] = $value;
    $_SESSION['array']['pd'] = $this->insert_personal_data;
}

function setInsertEmploymentValues($column, $value)
{
    array_push($this->insert_employment[$column], $value);
    $_SESSION['array']['emp'] = $this->insert_employment;
}

function setInsertSkillLanguageValues($column, $value)
{
    array_push($this->insert_skill_language[$column], $value);
    $_SESSION['array']['sk_lang'] = $this->insert_skill_language;
}

function setInsertSchoolValues($column, $value)
{
    array_push($this->insert_school[$column], $value);
    $_SESSION['array']['edu'] = $this->insert_school;
}

function setInsertCertSkillValues($column, $value)
{
    array_push($this->insert_cert_course[$column], $value);
    $_SESSION['array']['docs'] = $this->insert_cert_course;
}

function checkFlag()
{
    return $this->correct_data;
}

function notGood($err_name, $err_message)
{
    $this->correct_data = false;
    $_SESSION["$err_name"] = $err_message;
    echo "<div style='height: 20vh'> $err_message </div>";
}

function rememberValue($value_name)
{
    if (isset($_SESSION["$value_name"]))
    {
        echo $_SESSION["$value_name"];
        unset($_SESSION["$value_name"]);
    }
}

function setError($error_name)
{
    if (isset($_SESSION["$error_name"]))
    {
        echo '<div class="error">'.$_SESSION["$error_name"].'</div>';
        unset($_SESSION["$error_name"]);
    }
}

function checkDate($date)
{
    $day = date('d', $date);
    $month = date('m', $date);
    $year = date('Y', $date);
    if (!checkdate($month, $day, $year))
    {
        $this->notGood('err_date', 'This is not a valid date');
    }
}

function valiDate($start_date, $end_date)
{
    $curr_date = date("d-m-Y");
    if ($end_date == "Present")
    {
        $f_start_date = strtotime($start_date);
        if ($curr_date < $f_start_date)
        {
            $this->notGood('err_date', 'End date must be after start date');
        }
        $this->checkDate($f_start_date);
    }
    else
    {
        $f_start_date = strtotime($start_date);
        $ff_sd = date("d-m-Y", $f_start_date);
        $f_end_date = strtotime($end_date);
        $ff_ed = date("d-m-Y", $f_end_date);
        if ($ff_ed < $ff_sd || $curr_date < $ff_sd)
        {
            $this->notGood('err_date', 'End date must be after start date');
        }
        $this->checkDate($f_start_date);
        $this->checkDate($f_end_date);
    }
}

function validateForm1 ($username, $email, $password_one, $password_two, $position, $host, $db_user, $db_pass, $db_name)
{
    // Validate username

    if ((strlen($username) < 3) || (strlen($username) > 20))
    {
        $this->notGood('err_username', 'Username must have more than 3 and less than 20 characters');
    }
    if (ctype_alnum($username) == false)
    {
        $this->notGood('err_username', 'Username must contain only letters and numbers');
    }

    // Validate e-mail

    $sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ((filter_var($sanitized_email, FILTER_VALIDATE_EMAIL) == false) || ($sanitized_email != $email))
    {
        $this->notGood('err_email', 'Incorrect e-mail address');
    }

    // Validate password

    if ((strlen($password_one) < 8) || (strlen($password_one) > 30))
    {
        $this->notGood('err_password', 'Password must have more than 8 and less than 30 characters');
    }
    if ($password_one != $password_two)
    {
        $this->notGood('err_password', 'Passwords are not identical');
    }
    $hashed_password = password_hash($password_one, PASSWORD_DEFAULT);

    // Validate position


    // Validate terms of use
    if (!isset($_POST['terms-of-use']))
    {
        $correct_data = false;
        $this->notGood('err_terms', 'You must accept our Terms of Use and Privacy Policy');
    }

    // Validate CAPTCHA TODO add reCAPTCHA

    // Remember value
    $_SESSION['rem_username'] = $username;
    $_SESSION['rem_email'] = $email;
    $_SESSION['rem_password_one'] = $password_one;
    $_SESSION['rem_password_two'] = $password_two;
    $_SESSION['rem_position'] = $position;
    if (isset($_POST['terms-of-use'])) {
        $_SESSION['rem_terms'] = true;
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
            // Validate email uniqueness
            $result_email = $connection->query("SELECT id_user FROM applicants WHERE email='$email'");
            if (!$result_email)
            {
                throw new Exception($connection->error);
            }
            $count_input = $result_email->num_rows;
            if ($count_input > 0)
            {
                $this->notGood('err_email', 'Unavailable e-mail address');
            }
            // Validate username uniqueness
            $result_username = $connection->query("SELECT id_user FROM users WHERE login='$username'");
            if (!$result_username)
            {
                throw new Exception($connection->error);
            }
            $count_input = $result_username->num_rows;
            if ($count_input > 0)
            {
                $this->notGood('err_username', 'Unavailable username');
            }
            // Validate position with db
            $result_position = $connection->query("SELECT id_position FROM positions WHERE position = '{$position}'");
            if (!$result_position)
            {
                throw new Exception($connection->error);
            }
            else
            {
                $count_input = $result_position->num_rows;
                if ($count_input == 0)
                {
                    $this->notGood('err_position', 'Position currently unavailable');
                }
            }

            if ($this->checkFlag() == true)
            {
                // Add to array and wait
                $this->setInsertValue('username', $username);
                $this->setInsertValue('email', $email);
                $this->setInsertValue('password', $hashed_password);
                $this->setInsertValue('position', $position);
                $this->itWorks("form1");

            }
            $connection->close();
        }
    }
    catch(Exception $e)
    {
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
    }

}

function validateForm2 ($first_name, $last_name, $phone, $residence_country, $residence_city, $host, $db_user, $db_pass, $db_name)
{
    // Validate first name

    if (ctype_alpha($first_name) == false)
    {
        $this->notGood('err_first_name', 'First name may contain only letters');
    }

    //Validate last name

    if (ctype_alpha($last_name) == false)
    {
        $this->notGood('err_last_name', 'Last name may contain only letters');
    }

    //Validate phone number

    if (ctype_digit($phone) == false)
    {
        $this->notGood('err_phone', 'Phone number may contain only numbers');
    }
    if (strlen($phone) != 9)
    {
        $this->notGood('err_phone', 'Phone number must be 9 digits long');
    }

    //Validate country
    try
    {
        $connection = new mysqli($host, $db_user, $db_pass, $db_name);
        if ($connection->connect_errno != 0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            $result_country = $connection->query("SELECT id_country FROM countries WHERE country = '{$residence_country}'");
            if (!$result_country)
            {
                throw new Exception($connection->error);
            }
            else
            {
                $count_input = $result_country->num_rows;
                if ($count_input == 0)
                {
                    $this->notGood('err_residence_country', 'U crazy? Dis ain&apos;t no country');
                }
            }
            $connection->close();
        }
    }
    catch (Exception $e)
    {
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
    }

    //Validate city
    if (ctype_alpha($residence_city) == false)
    {
        $this->notGood('err_residence_city', 'City name may contain only letters');
    }

    // Remember value
    $_SESSION['rem_first_name'] = $first_name;
    $_SESSION['rem_last_name'] = $last_name;
    $_SESSION['rem_phone'] = $phone;
    $_SESSION['rem_residence_country'] = $residence_country;
    $_SESSION['rem_residence_city'] = $residence_city;

    if ($this->checkFlag() == true)
    {
        //Add to array and wait
        $this->setInsertPersonalData('first_name', $first_name);
        $this->setInsertPersonalData('last_name', $last_name);
        $this->setInsertPersonalData('phone', $phone);
        $this->setInsertPersonalData('residence_country', $residence_country);
        $this->setInsertPersonalData('residence_city', $residence_city);
        $this->itWorks('form2');
    }
}

function validateForm3($job_title, $no_experience, $employer, $start_date, $end_date, $job_city, $job_description)
{
    if ($no_experience == false)
    {
        // Validate job title
        if (ctype_alnum($job_title) == false)
        {
            $this->notGood('err_job_title', 'Job title may only contain letters and numbers');
        }
        if (strlen($job_title) > 40)
        {
            $this->notGood('err_job_title', 'Job title must have less than 40 characters');
        }

        // Validate employer
        if (ctype_alnum($employer) == false)
        {
            $this->notGood('err_employer', 'Employer name may only contain letters and numbers');
        }
        if (strlen($employer) > 40)
        {
            $this->notGood('err_employer', 'Employer name must have less than 40 characters');
        }

        // Validate date
        $this->valiDate($start_date, $end_date);

        //Validate city
        if (ctype_alpha($job_city) == false)
        {
            $this->notGood('err_job_city', 'City name may contain only letters');
        }

        // Validate description
        if (ctype_alnum($job_description) == false)
        {
            $this->notGood('err_job_description', 'Description may only contain letters and numbers');
        }
        if (strlen($job_description) > 500)
        {
            $this->notGood('err_job_description', 'Description must have less than 500 characters');
        }
        // Remember value
        $_SESSION['rem_job_title'] = $job_title;
        $_SESSION['rem_employer'] = $employer;
        $_SESSION['rem_start_date'] = $start_date;
        $_SESSION['rem_end_date'] = $end_date;
        $_SESSION['rem_job_city'] = $job_city;
        $_SESSION['rem_description'] = $job_description;


        if ($this->checkFlag() == true)
        {
            //Add to array and wait
            $this->setInsertEmploymentValues('job_title', $job_title);
            $this->setInsertEmploymentValues('employer', $employer);
            $this->setInsertEmploymentValues('start_date', $start_date);
            $this->setInsertEmploymentValues('end_date', $end_date);
            $this->setInsertEmploymentValues('city', $job_city);
            $this->setInsertEmploymentValues('description', $job_description);
            $this->itWorks('form3');
        }
    }
    else
    {
        // TODO co robic gdy nie ma doswiadczenia -- chyba nic
    }
}

function validateForm4L($language, $language_level)
{
    // Validate language
    if (($language_level < 1) && ($language_level > 5))
    {
        $this->notGood('err_language_level', 'Language level must be between 1 and 5');
    }

    if (ctype_alnum($language) == false)
    {
        $this->notGood('err_language', 'Language name may only contain letters and numbers');
    }

    // Remember value
    $_SESSION['rem_language'] = $language;
    $_SESSION['rem_language_level'] = $language_level;

    if ($this->checkFlag() == true)
    {
        //Add to array and wait
        $this->setInsertSkillLanguageValues('language', $language);
        $this->setInsertSkillLanguageValues('language_level', $language_level);
        $this->itWorks('form4l');
    }

    // Unset remembered values
    if (isset($_SESSION['rem_language'])) unset($_SESSION['rem_language']);
    if (isset($_SESSION['rem_language_level'])) unset($_SESSION['rem_language_level']);

    // Unset error values
    if (isset($_SESSION['err_language'])) unset($_SESSION['err_language']);
    if (isset($_SESSION['err_language_level'])) unset($_SESSION['err_language_level']);
}

function validateForm4Sk($skill, $skill_level)
{
    // Validate skills
    if (($skill_level < 1) && ($skill_level > 5))
    {
        $this->notGood('err_skill_level', 'Skill level must be between 1 and 5');
    }

    if (ctype_alnum($skill) == false)
    {
        $this->notGood('err_skill', 'Skill name may only contain letters and numbers');
    }


    // Remember value
    $_SESSION['rem_skill'] = $skill;
    $_SESSION['rem_skill_level'] = $skill_level;

    if ($this->checkFlag() == true)
    {
        //Add to array and wait
        $this->setInsertSkillLanguageValues('skill', $skill);
        $this->setInsertSkillLanguageValues('skill_level', $skill_level);
        $this->itWorks('form4sk');
    }
}

function validateForm4S($school, $specialization, $school_start_date, $school_end_date, $school_city, $school_description)
{
    if (ctype_alnum($school) == false)
    {
        $this->notGood('err_school', 'School name may only contain letters and numbers');
    }

    if (ctype_alnum($specialization) == false)
    {
        $this->notGood('err_specialization', 'Specialization name may only contain letters and numbers');
    }

    $this->valiDate($school_start_date, $school_end_date);

    if (ctype_alpha($school_city) == false)
    {
        $this->notGood('err_school_city', 'City name may contain only letters');
    }

    if (ctype_alnum($school_description) == false)
    {
        $this->notGood('err_school_description', 'Description may only contain letters and numbers');
    }
    if (strlen($school_description) > 500)
    {
        $this->notGood('err_school_description', 'Description must have less than 500 characters');
    }
    // Remember value
    $_SESSION['rem_school'] = $school;
    $_SESSION['rem_specialization'] = $specialization;
    $_SESSION['rem_school_start_date'] = $school_start_date;
    $_SESSION['rem_school_end_date'] = $school_end_date;
    $_SESSION['rem_school_city'] = $school_city;
    $_SESSION['rem_school_description'] = $school_description;

    if ($this->checkFlag() == true)
    {
        //Add to array and wait
        $this->setInsertSchoolValues('school', $school);
        $this->setInsertSchoolValues('specialization', $specialization);
        $this->setInsertSchoolValues('start_date', $school_start_date);
        $this->setInsertSchoolValues('end_date', $school_end_date);
        $this->setInsertSchoolValues('city', $school_city);
        $this->setInsertSchoolValues('description', $school_description);
        $this->itWorks('form4s');
    }
}

function validateFile($filename, $multi_file, $col_name)
{
    if ($multi_file == false){
        $whitelist = array("pdf");
        // Get filename
        $file_info = pathinfo($_FILES[$filename]['name']);
        $ext = $file_info['extension'];
        // Validate file's extension
        if (!in_array($ext, $whitelist)) {
            $this->notGood('err_file', 'Files must have .pdf extension');
        }

        $upload_dir = 'uploads/';
        $file_to_upload = $upload_dir . basename($_FILES[$filename]['name']);

        $tmp_name = $_FILES[$filename]["tmp_name"];
        //Add to array and wait
        if ($this->checkFlag() == true) {
            if (move_uploaded_file($tmp_name, "$file_to_upload")) {
                $this->setInsertCertSkillValues($col_name, $filename);
                $this->itWorks("form5cv");
                return true;
            } else {
                $this->notGood('err_file', 'Uploading files failed');
                echo $upload_dir;
                echo $_FILES[$filename]['name'];
                $this->itWorks('except it doesnt');
            }
        }
    } else {
        $target_dir = "uploads/";
        if( isset($_FILES[$filename]['name'])) {

            $total_files = count($_FILES[$filename]['name']);

            for($key = 0; $key < $total_files; $key++) {

                // Check if file is selected
                if(isset($_FILES[$filename]['name'][$key]) && $_FILES[$filename]['size'][$key] > 0) {
                    $original_filename = $_FILES[$filename]['name'][$key];
                    $target = $target_dir . basename($original_filename);
                    $tmp  = $_FILES[$filename]['tmp_name'][$key];
                    move_uploaded_file($tmp, $target);
                    $this->setInsertCertSkillValues($col_name, $filename);
                    $this->itWorks('form5ce');
                }
            }
        }
    }
}

function validateForm5Co($course)
{
    // Validate course
    if (ctype_alnum($course) == false)
    {
        $this->notGood('err_course', 'Course name may contain only letters and numbers');
    }
    if (strlen($course) > 50)
    {
        $this->notGood('err_course', 'Course name must have less than 50 characters');
    }

    // Remember values
    $_SESSION['rem_course'] = $course;

    if ($this->checkFlag() == true)
    {
        //Add to array and wait
        $this->setInsertCertSkillValues('course', $course);
        $this->itWorks('form5co');
    }
}
// TESTING FUNCTIONS
function itWorks($p)
{
    $_SESSION[$p] = true;
    header("Location: /sign_up.php");
    // echo "<div style='height: 20vh'> It works! " . $p . " </div>";
}

function dispInJson()
{
    require_once "HandleJson.php";

    $arr = $_SESSION['array'];
    $inst = new HandleJson();
    $inst->createJsonFile('signup.json',$arr);
}



}

