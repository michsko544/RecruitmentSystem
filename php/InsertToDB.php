<?php


class InsertToDB
{
    private $conn = null;
    function __construct($host, $db_user, $db_pass, $db_name)
    {
        $this->conn = new mysqli($host, $db_user, $db_pass, $db_name);
    }

    function checkCity($city){
        $cR = $this->conn->query("select id_city from cities where locality = '{$city}'");
        if ($cR->num_rows == 1) {
            return $id_city_Q = $cR['id_city'];
        } else {
            $this->conn->query("insert into `cities` (`id_city`, `locality`) values (null, '{$city}')");
            return $this->checkCity($city);
        }
    }

    function checkLanguage($lang){
        $cR = $this->conn->query("select id_language from languages where language = '{$lang}'");
        if ($cR->num_rows == 1) {
            return $id_language_Q = $cR['id_language'];
        } else {
            $this->conn->query("insert into `languages` (`id_language`, `language`) values (null, '{$lang}')");
            return $this->checkLanguage($lang);
        }
    }

    function checkSkill($skill){
        $cR = $this->conn->query("select id_skill from skills where sience = '{$skill}'");
        if ($cR->num_rows == 1) {
            return $id_skill_Q = $cR['id_skill'];
        } else {
            $this->conn->query("insert into `skills` (`id_skill`, `sience`) values (null, '{$skill}')");
            return $this->checkSkill($skill);
        }
    }

    function checkPosition($pos){
        $cR = $this->conn->query("select id_position from positions where position = '{$pos}'");
        return $id_position_Q = $cR['id_position'];
    }

    function insertSignUp(){

        if ($this->conn->connect_errno!=0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            // TODO add multiple filed insert
            if ($this->conn->query("insert into users (id_user, login, name, surname, pass, id_role) VALUES (null, '{$_SESSION['array']['val']['username']}', '{$_SESSION['array']['pd']['first_name']}', '{$_SESSION['array']['pd']['last_name']}', '{$_SESSION['array']['val']['password']}', 2)" ) ) {

                $cv_Q = $this->conn->query("select id_cv from cv order by id_cv desc limit 1");
                $id_cv_Q = $cv_Q['id_cv']++;

                $id_city_Q = $this->checkCity($_SESSION['array']['pd']['residence-city']);

                $user_Q = $this->conn->query("select id_user from users order by id_user desc limit 1");
                $id_user_Q = $user_Q['id_user']++;

                $certificate_Q = $this->conn->query("select id_certificate from certificates order by id_certificate desc limit 1");
                $id_cert_Q = $certificate_Q['id_certificate']++;

                $country_Q = $this->conn->query("select id_country from countries where country = '{$$_SESSION['array']['pd']['residence-country']}'");
                $id_country_Q = $country_Q['id_country'];

                if ($this->conn->query("insert into applicants (id_applicants, phone, email, id_cv, id_city, id_user, id_certificate, id_country) VALUES (null, '{$_SESSION['array']['pd']['phone']}', '{$_SESSION['array']['val']['email']}', {$id_cv_Q}, {$id_city_Q}, {$id_user_Q}, {$id_cert_Q}, {$id_country_Q})")){
                    $id_city_Q = $this->checkCity($_SESSION['array']['emp']['city']);

                    $applicant_Q = $this->conn->query("select id_applicants from applicants where email = '{$_SESSION['array']['val']['email']}'");
                    $id_applicant_Q = $applicant_Q['id_applicants'];

                    if ($this->conn->query("INSERT INTO `experiences`(`id_experience`, `job`, `employer`, `start_job`, `end_job`, `description`, `id_city`, `id_applicants`) VALUES (null,'{$_SESSION['array']['emp']['job_title']}','{$_SESSION['array']['emp']['employer']}','{$_SESSION['array']['emp']['start_date']}', '{$_SESSION['array']['emp']['end_date']}','{$_SESSION['array']['emp']['description']}',{$id_city_Q}, {$id_applicant_Q})")) {
                        $id_language_Q = $this->checkLanguage($_SESSION['array']['sk_lang']['language']);

                        $id_lang_level_Q = intval($_SESSION['array']['sk_lang']['language_level']);

                        if ($this->conn->query("INSERT INTO `knowledge`(`id_knowledge`, `id_level`, `id_applicants`, `id_language`) VALUES (null, {$id_lang_level_Q}, {$id_applicant_Q}, {$id_language_Q})")){
                            $id_skill_Q = $this->checkSkill($_SESSION['array']['sk_lang']['skill']);

                            $id_skill_level_Q = intval($_SESSION['array']['sk_lang']['skill_level']);

                            if ($this->conn->query("INSERT INTO `holders`(`id_holder`, `id_level`, `id_applicants`, `id_skill`) VALUES (null, {$id_skill_level_Q}, {$id_applicant_Q}, {$id_skill_Q})")){
                                $id_city_Q = $this->checkCity($_SESSION['array']['edu']['city']);

                                if ($this->conn->query("INSERT INTO `schools`(`id_school`, `name_school`, `specialization`, `start_learning`, `end_learning`, `description`, `id_city`, `id_applicants`) VALUES (null, '{$_SESSION['array']['edu']['school']}', '{$_SESSION['array']['edu']['specialization']}', '{$_SESSION['array']['edu']['start_date']}', '{$_SESSION['array']['edu']['end_date']}', '{$_SESSION['array']['edu']['description']}', {$id_city_Q}, {$id_applicant_Q})")){

                                    $id_position_Q = $this->checkPosition($_SESSION['array']['val']['position']);
                                    // TODO cover letter

                                    if ($this->conn->query("insert into `applications` (`id_application`, `id_applicants`, `id_decision`, `id_position`, `id_status`, `id_cl`) values (null, {$id_applicant_Q}, 3, {$id_position_Q}, 1, 1)"));{ // TODO add cover letter id
                                        $_SESSION['successful-sign-up'] = true;
                                        header ('Location: /sing_in.php');
                                    }
                                }
                            }
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