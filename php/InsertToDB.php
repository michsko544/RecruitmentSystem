<?php


class InsertToDB
{
    protected $conn = null;
    protected $id_city_FQ = 0;
    protected $id_language_FQ = 0;
    protected $id_skill_FQ = 0;

    function __construct($host, $db_user, $db_pass, $db_name)
    {
        mysqli_report(MYSQLI_REPORT_STRICT);
        try{
            $this->conn = new mysqli($host, $db_user, $db_pass, $db_name);
            if ($this->conn->connect_errno!=0){
                throw new Exception($this->conn->error);
            }
        } catch (Exception $e){
            require_once "addError.php";
            addError($e);
            echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
        }
    }

    function addDocs($id_applicants, $filename, $file_type){
        try{
            if ($this->conn->connect_errno!=0){
                throw new Exception($this->conn->error);
            } else {
                if ($file_type == 'cv'){
                    $this->conn->query("insert into cv (id_cv, description, id_applicants) values (null, '{$filename}', {$id_applicants})");
                } elseif ($file_type == 'cert'){
                    $this->conn->query("insert into certifications (id_certificate, descriptions, id_applicants) values (null, '{$filename}', {$id_applicants})");
                } elseif ($file_type == 'cl'){
                    $this->conn->query("insert into cl (id_cl, description, id_application) values (null, '{$filename}', {$id_applicants})");
                }
            }
        } catch (Exception $e){
            require_once ($_SERVER['DOCUMENT_ROOT']."/php/addError.php");
            addError($e);
            echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
        }
    }

    function checkCity($city){
        $cR = $this->conn->query("select id_city from cities where locality = '{$city}'");
        if ($cR->num_rows == 1) {
            $cRV = $cR->fetch_assoc();
            $id_city_Q = $cRV['id_city'];
            $this->id_city_FQ = $id_city_Q;
        } else {
            if ($this->conn->query("insert into cities (id_city, locality) values (null, '{$city}')"))
                $this->checkCity($city);
            else
                return null;
        }
    }

    function checkLanguage($lang){
        $cR = $this->conn->query("select id_language from languages where language = '{$lang}'");
        if ($cR->num_rows == 1) {
            $cRV = $cR->fetch_assoc();
            $id_language_Q = $cRV['id_language'];
            $this->id_language_FQ = $id_language_Q;
        } else {
            $this->conn->query("insert into languages (id_language, language) values (null, '{$lang}')");
            $this->checkLanguage($lang);
        }
    }

    function checkSkill($skill){
        $cR = $this->conn->query("select id_skill from skills where sience = '{$skill}'");
        if ($cR->num_rows == 1) {
            $cRV = $cR->fetch_assoc();
            $id_skill_Q = $cRV['id_skill'];
            $this->id_skill_FQ = $id_skill_Q;
        } else {
            $this->conn->query("insert into skills (id_skill, sience) values (null, '{$skill}')");
            $this->checkSkill($skill);
        }
    }

    function checkPosition($pos){
        $cR = $this->conn->query("select id_position from positions where position = '{$pos}'");
        $cRV = $cR->fetch_assoc();
        return $id_position_Q = $cRV['id_position'];
    }

    function insertSignUp(){
        if ($this->conn->connect_errno!=0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            $timestamp = date("Y-m-d");
            if ($this->conn->query("insert into users (id_user, login, name, surname, pass, id_role, date) VALUES (null, '{$_SESSION['array']['val']['username']}', '{$_SESSION['array']['pd']['first_name']}', '{$_SESSION['array']['pd']['last_name']}', '{$_SESSION['array']['val']['password']}', 2, '{$timestamp}')" ) ) {

                $cv_Q = $this->conn->query("select id_cv from cv order by id_cv desc limit 1");
                $cv_V = $cv_Q->fetch_assoc();
                $id_cv_Q = $cv_V['id_cv'];
                $id_cv_Q++;
                $id_city_Q = $this->checkCity($_SESSION['array']['pd']['residence_city'][0]);
                $user_Q = $this->conn->query("select id_user from users order by id_user desc limit 1");
                $user_V = $user_Q->fetch_assoc();
                $id_user_Q = $user_V['id_user'];
                $certificate_Q = $this->conn->query("select id_certificate from certifications order by id_certificate desc limit 1");
                $certificate_V = $certificate_Q->fetch_assoc();
                $id_cert_Q = $certificate_V['id_certificate'];
                $id_cert_Q++;
                $country_Q = $this->conn->query("select id_country from countries where country = '{$_SESSION['array']['pd']['residence_country']}'");
                $country_V = $country_Q->fetch_assoc();
                $id_country_Q = $country_V['id_country'];
                if ($this->conn->query("insert into applicants (id_applicants, phone, email, id_cv, id_city, id_user, id_certificate, id_country) VALUES (null, '{$_SESSION['array']['pd']['phone']}', '{$_SESSION['array']['val']['email']}', {$id_cv_Q}, {$this->id_city_FQ}, {$id_user_Q}, {$id_cert_Q}, {$id_country_Q})")){

                    $applicant_Q = $this->conn->query("select id_applicants from applicants where email = '{$_SESSION['array']['val']['email']}'");
                    $applicant_V = $applicant_Q->fetch_assoc();
                    $id_applicant_Q = $applicant_V['id_applicants'];

                    $w0 = 0;
                    while (isset($_SESSION['array']['emp']['city'][$w0])) {
                        $id_city_Q = $this->checkCity($_SESSION['array']['emp']['city'][$w0]);
                        $this->conn->query("insert into experiences (id_experience, job, employer, start_job, end_job, description, id_city, id_applicants) VALUES (null,'{$_SESSION['array']['emp']['job_title'][$w0]}','{$_SESSION['array']['emp']['employer'][$w0]}','{$_SESSION['array']['emp']['start_date'][$w0]}', '{$_SESSION['array']['emp']['end_date'][$w0]}','{$_SESSION['array']['emp']['description'][$w0]}',{$this->id_city_FQ}, {$id_applicant_Q})");
                        $w0++;
                    }
                    $w1 = 0;
                    while (isset($_SESSION['array']['sk_lang']['language'][$w1])) {
                        $this->checkLanguage($_SESSION['array']['sk_lang']['language'][$w1]);
                        $id_lang_level_Q = intval($_SESSION['array']['sk_lang']['language_level'][$w1]);
                        $this->conn->query("insert into knowledge (id_knowledge, id_level, id_applicants, id_language) VALUES (null, {$id_lang_level_Q}, {$id_applicant_Q}, {$this->id_language_FQ})");
                        $w1++;
                    }
                    $w2 = 0;
                    while (isset($_SESSION['array']['sk_lang']['skill'][$w2])){
                        $this->checkSkill($_SESSION['array']['sk_lang']['skill'][$w2]);
                        $id_skill_level_Q = intval($_SESSION['array']['sk_lang']['skill_level'][$w2]);
                        $this->conn->query("insert into holders (id_holder, id_level, id_applicants, id_skill) VALUES (null, {$id_skill_level_Q}, {$id_applicant_Q}, {$this->id_skill_FQ})");
                        $w2++;
                    }
                    $w3 = 0;
                    while (isset($_SESSION['array']['edu']['city'][$w3])) {
                        $id_city_Q = $this->checkCity($_SESSION['array']['edu']['city'][$w3]);
                        $this->conn->query("insert into schools (id_school, name_school, specialization, start_learning, end_learning, description, id_city, id_applicants) VALUES (null, '{$_SESSION['array']['edu']['school'][$w3]}', '{$_SESSION['array']['edu']['specialization'][$w3]}', '{$_SESSION['array']['edu']['start_date'][$w3]}', '{$_SESSION['array']['edu']['end_date'][$w3]}', '{$_SESSION['array']['edu']['description'][$w3]}', {$this->id_city_FQ}, {$id_applicant_Q})");
                        $w3++;
                    }

                    $id_position_Q = $this->checkPosition($_SESSION['array']['val']['position']);

                    if ($this->conn->query("insert into applications (id_application, id_applicants, id_decision, id_position, id_status, id_cl, date, id_conv) values (null, {$id_applicant_Q}, 4, {$id_position_Q}, 1, 1, '{$timestamp}', null)"));{

                        $application_Q = $this->conn->query("select id_application from applications where id_applicants = {$id_applicant_Q} order by date desc limit 1");
                        $application_V = $application_Q->fetch_assoc();
                        $id_application_Q = $application_V['id_application'];
                        $this->addDocs($id_applicant_Q, $_SESSION['array']['docs']['cv'], 'cv');
                        $this->addDocs($id_applicant_Q, $_SESSION['array']['docs']['cert'], 'cert');
                        $this->addDocs($id_application_Q, $_SESSION['array']['docs']['cl'], 'cl');
                        if ($this->conn->query("insert into training (id_training, training, description, id_applicants) values (null, '{$_SESSION['array']['docs']['course']}', '', {$id_applicant_Q})")){
                            $_SESSION['successful-sign-up'] = true;
                            header ('Location: ../sign_in.php');
                        }
                    }
                } else {
                    throw new Exception($this->conn->error);
                }
            } else {
                throw new Exception($this->conn->error);
            }
        }
    }
}