<?php
require_once "InsertToDB.php";
class UpdateData extends InsertToDB
{
    public function __construct($host, $db_user, $db_pass, $db_name)
    {
        parent::__construct($host, $db_user, $db_pass, $db_name);
    }

    function updateProfile(){
        if ($this->conn->connect_errno!=0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            // TODO add multiple filed insert
            $this->itWorks('pre-insert');
            $timestamp = date("Y-m-d");
            if ($this->conn->query("insert into users (id_user, login, name, surname, pass, id_role, date) VALUES (null, '{$_SESSION['array']['val']['username']}', '{$_SESSION['array']['pd']['first_name']}', '{$_SESSION['array']['pd']['last_name']}', '{$_SESSION['array']['val']['password']}', 2, '{$timestamp}')" ) ) {
                // *************** COS SIE Psuje *******************
                $this->itWorks("</br> query-1-success");

                $cv_Q = $this->conn->query("select id_cv from cv order by id_cv desc limit 1");
                $cv_V = $cv_Q->fetch_assoc();
                $id_cv_Q = $cv_V['id_cv'];
                $id_cv_Q++;

                $this->itWorks("</br> cv-val: " . $id_cv_Q);

                $id_city_Q = $this->checkCity($_SESSION['array']['pd']['residence_city'][0]);

                $this->itWorks("</br> city-val: " . $this->id_city_FQ);

                $user_Q = $this->conn->query("select id_user from users order by id_user desc limit 1");
                $user_V = $user_Q->fetch_assoc();
                $id_user_Q = $user_V['id_user'];

                $this->itWorks("</br> user-val: " . $id_user_Q);

                $certificate_Q = $this->conn->query("select id_certificate from certifications order by id_certificate desc limit 1");
                $certificate_V = $certificate_Q->fetch_assoc();
                $id_cert_Q = $certificate_V['id_certificate'];
                $id_cert_Q++;
                // TODO sth it no yes
                $this->itWorks("</br> cert-val: " . $id_cert_Q);

                $country_Q = $this->conn->query("select id_country from countries where country = '{$_SESSION['array']['pd']['residence_country']}'");
                $country_V = $country_Q->fetch_assoc();
                $id_country_Q = $country_V['id_country'];

                $this->itWorks("</br> country-val: " . $id_country_Q);
                // *************** COS SIE Psuje END *******************
                // TODO wiele formularzy
                if ($this->conn->query("insert into applicants (id_applicants, phone, email, id_cv, id_city, id_user, id_certificate, id_country) VALUES (null, '{$_SESSION['array']['pd']['phone']}', '{$_SESSION['array']['val']['email']}', {$id_cv_Q}, {$this->id_city_FQ}, {$id_user_Q}, {$id_cert_Q}, {$id_country_Q})")){
                    $id_city_Q = $this->checkCity($_SESSION['array']['emp']['city'][0]);

                    $this->itWorks("</br> query-2-success");

                    $applicant_Q = $this->conn->query("select id_applicants from applicants where email = '{$_SESSION['array']['val']['email']}'");
                    $applicant_V = $applicant_Q->fetch_assoc();
                    $id_applicant_Q = $applicant_V['id_applicants'];
                    $this->itWorks("</br> id_applicant-val: " . $id_applicant_Q);

                    // TODO --- add multi insert ---
                    if ($this->conn->query("insert into experiences (id_experience, job, employer, start_job, end_job, description, id_city, id_applicants) VALUES (null,'{$_SESSION['array']['emp']['job_title'][0]}','{$_SESSION['array']['emp']['employer'][0]}','{$_SESSION['array']['emp']['start_date'][0]}', '{$_SESSION['array']['emp']['end_date'][0]}','{$_SESSION['array']['emp']['description'][0]}',{$this->id_city_FQ}, {$id_applicant_Q})")) {
                        $this->checkLanguage($_SESSION['array']['sk_lang']['language'][0]);
                        echo "</br> query-3-success";
                        $id_lang_level_Q = intval($_SESSION['array']['sk_lang']['language_level'][0]);

                        if ($this->conn->query("insert into knowledge (id_knowledge, id_level, id_applicants, id_language) VALUES (null, {$id_lang_level_Q}, {$id_applicant_Q}, {$this->id_language_FQ})")){
                            $this->checkSkill($_SESSION['array']['sk_lang']['skill'][0]);
                            echo "</br> query-4-success";
                            $id_skill_level_Q = intval($_SESSION['array']['sk_lang']['skill_level'][0]);

                            if ($this->conn->query("insert into holders (id_holder, id_level, id_applicants, id_skill) VALUES (null, {$id_skill_level_Q}, {$id_applicant_Q}, {$this->id_skill_FQ})")){
                                $id_city_Q = $this->checkCity($_SESSION['array']['edu']['city'][0]);
                                echo "</br> query-4-success";
                                if ($this->conn->query("insert into schools (id_school, name_school, specialization, start_learning, end_learning, description, id_city, id_applicants) VALUES (null, '{$_SESSION['array']['edu']['school'][0]}', '{$_SESSION['array']['edu']['specialization'][0]}', '{$_SESSION['array']['edu']['start_date'][0]}', '{$_SESSION['array']['edu']['end_date'][0]}', '{$_SESSION['array']['edu']['description'][0]}', {$this->id_city_FQ}, {$id_applicant_Q})")){
                                    echo "</br> query-5-success";
                                    $id_position_Q = $this->checkPosition($_SESSION['array']['val']['position']);
                                    // TODO cover letter
                                    // TODO --- add multi insert ---
                                    if ($this->conn->query("insert into applications (id_application, id_applicants, id_decision, id_position, id_status, id_cl, date, id_conv) values (null, {$id_applicant_Q}, 4, {$id_position_Q}, 1, 1, '{$timestamp}', )"));{ // TODO add cover letter id
                                        echo "</br> query-6-success";
                                        $_SESSION['successful-sign-up'] = true;
                                        header ('Location: ../profile.php?uD=success');
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