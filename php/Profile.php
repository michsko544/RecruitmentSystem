<?php
require_once "connect.php";
class Profile
{
    private $experience_form_p1 = " <div class=\"list-row\">
            <div class=\"title-element\">Experience</div>
            <div class=\"btn-element\">
                <div class=\"btn-unwrap\">
                    <div class=\"line1\"></div>
                    <div class=\"line2\"></div>
                </div>
            </div>
        </div>
        <div class=\"list-row hide\" id=\"experience\">
            <div class=\"element-wrapper\">
                <div class=\"form-row\">
                    <div class=\"checkbox\">
                        <input type=\"checkbox\" name=\"no-experience\"  value=\"\" id=\"no-experience\">I don't  have any experience
                    </div>
                </div>
                <div class=\"form-row\">
                    <label for=\"job-title\">Job title</label>
                    <input type=\"text\" name=\"job-title-0\" value=\"\">
                    <div class=\"underline\"></div>
                </div>
                <div class=\"form-row\">
                    <label for=\"employer\">Employer</label>
                    <input type=\"text\" name=\"employer-0\" value=\"\">
                    <div class=\"underline\"></div>
                </div>
                <div class=\"form-row\">
                    <label for=\"start-end-date\">Start & End date</label>
                    <div class=\"date\">
                        <input type=\"text\" id=\"start-exp-0\" class=\"start-date\" name=\"start-date-0\" onchange=\"this.value=convertDateDisplay(this.id)\" value=\"\">

                        <input type=\"text\" id=\"end-exp-0\" class=\"end-date\" name=\"end-date-0\"  onchange=\"this.value=convertDateDisplay(this.id)\" value=\"\">

                    </div>
                </div>
                <div class=\"form-row\">
                    <label for=\"job-city\">City</label>
                    <input type=\"text\" name=\"job-city-0\" value=\"\">
                    <div class=\"underline\"></div>
                </div>
                <div class=\"form-row\">
                    <label for=\"job-description\">Description</label>
                    <textarea name=\"job-description-0\" cols=\"35\" rows=\"4\">  </textarea>
                    <div class=\"underlineTA\"></div>
                </div>
                <div class=\"btn-add\" id=\"btn-experiance\">
                    <div class=\"btn-text\">
                        Add employment <!--TODO var exp-count -->
                    </div>
                    <div class=\"btn-border\">
                        <div class=\"btn-icon\">
                        +
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    private $education_form_p1 = "<div class=\"list-row\">
            <div class=\"title-element\">Education</div>
            <div class=\"btn-element\">
                <div class=\"btn-unwrap\">
                    <div class=\"line1\"></div>
                    <div class=\"line2\"></div>
                </div>
            </div>
        </div>
        <div class=\"list-row hide\" id=\"education\">
            <div class=\"element-wrapper\">
                <div class=\"form-row\">
                    <label for=\"school\">School</label>
                    <input type=\"text\" name=\"school-0\" value=\"\" required>
                    <div class=\"underline\"></div>
                </div>
                <div class=\"form-row\">
                    <label for=\"specialization\">Specialization</label>
                    <input type=\"text\" name=\"specialization-0\" value=\"\" required>
                    <div class=\"underline\"></div>
                </div>
                <div class=\"form-row\">
                    <label for=\"start-end-date\">Start & End date</label>
                    <div class=\"date\">
                        <input type=\"text\" id=\"start-school-0\" class=\"start-date\" name=\"school-start-date-0\" value=\"\" required>
                        <input type=\"text\" id=\"end-school-0\" class=\"end-date\" name=\"school-end-date-0\" value=\"\" required>
                    </div>
                </div>
                <div class=\"form-row\">
                    <label for=\"school-city\">City</label>
                    <input type=\"text\" name=\"school-city-0\" value=\"\" required>
                    <div class=\"underline\"></div>
                </div>
                <div class=\"form-row\">
                    <label for=\"school-description\">Description</label>
                    <textarea name=\"school-description-0\" cols=\"35\" rows=\"4\">  </textarea>
                    <div class=\"underlineTA\"></div>
                </div>
                <div class=\"btn-add\" id=\"btn-school\">
                    <div class=\"btn-text\">
                        Add school <!-- TODO var school-count -->
                    </div>
                    <div class=\"btn-border\">
                        <div class=\"btn-icon\">
                        +
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    private $skills_form_p1 = "<div class=\"list-row\">
            <div class=\"title-element\">Skills</div>
            <div class=\"btn-element\">
                <div class=\"btn-unwrap\">
                    <div class=\"line1\"></div>
                    <div class=\"line2\"></div>
                </div>
            </div>
        </div>
        <div class=\"list-row hide\" id=\"skills\">
            <div class=\"element-wrapper\">";
    private $skills_form_mux1 = "<div class=\"form-row relative\">
                    <label for=\"languages\">Languages</label>
                    <input type=\"text\" name=\"languages-0\" placeholder=\"German\" value='";

    private $skills_form_p2 = "' required>
                    <div class=\"underline\"></div>
                <div class=\"degree\">
                    <input type=\"number\" name=\"language-level-0\" min=1 max=5 placeholder=1 value='";

    private $skills_form_p3 = "'>
                        <div class=\"limit\">/5</div>
                    </div>
                </div>";
    private $skills_form_mux2 = "<div class=\"btn-add\" id=\"btn-language\">
                    <div class=\"btn-text\">
                        Add language
                    </div>
                    <div class=\"btn-border\">
                        <div class=\"btn-icon\">
                        +
                        </div>
                    </div>
                </div>";
    private $skills_form_mux3 = "<div class=\"form-row relative\">
                    <label for=\"skills\">Skills</label>
                    <input type=\"text\" name=\"skills-0\" placeholder=\"Marketing\" value='";

    private $skills_form_p4 = "' required>
                    <div class=\"underline\"></div>
                    <div class=\"degree\">
                        <input type=\"number\" name=\"skill-level-0\" min=1 max=5 placeholder=1 value='";

    private $skills_form_p5 = "'>
                        <div class=\"limit\">/5</div>
                    </div>
                </div>";
    private $skills_form_mux4 = "<div class=\"btn-add\" id=\"btn-skill\">
                    <div class=\"btn-text\">
                        Add skill
                    </div>
                    <div class=\"btn-border\">
                        <div class=\"btn-icon\">
                        +
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    private $additional_form_p1 = "<div class=\"list-row\">
            <div class=\"title-element\">Additional</div>
            <div class=\"btn-element\">
                <div class=\"btn-unwrap\">
                    <div class=\"line1\"></div>
                    <div class=\"line2\"></div>
                </div>
            </div>
        </div>
        <div class=\"list-row hide\" id=\"addition\">
            <div class=\"element-wrapper\">
                <div class=\"form-row\">
                    <label for=\"cv-file\">Curriculum vitae</label>
                    <div class=\"upload\">
                        <input type=\"file\" name=\"cv-file\" class=\"inputfile\"  value=\"\" accept=\"application/pdf\">
                        <label for=\"cv-file\">Choose a file</label>
                    </div>
                </div>
                <div class=\"form-row \">
                    <label for=\"certificate-file\">Certificates</label>
                    <div class=\"upload\">
                        <input type=\"file\" name=\"certificate-file-0\" class=\"inputfile\" value=\"\" accept=\"application/pdf\" data-multiple-caption=\"{count} files selected\"     multiple>
                        <label>Choose a file</label>
                    </div>
                </div>
                <div class=\"form-row\">
                    <label for=\"lm-file\">Cover Letter</label>
                        <div class=\"upload\">
                        <input type=\"file\" name=\"lm-file\" class=\"inputfile\" value=\"\" accept=\"application/pdf\" data-multiple-caption=\"{count} files selected\" multiple>
                        <label>Choose a file</label>
                    </div>
                </div>
                <div class=\"form-row\">
                    <label for=\"course\">Courses</label>
                    <input type=\"text\" name=\"course-0\" placeholder=\"e.g. Google Internet Revolutions\" value=\"\">
                    <div class=\"underline\"></div>
                </div>
                <div class=\"btn-add\" id=\"btn-course\">
                    <div class=\"btn-text\">
                        Add Course <!-- TODO var docs-count -->
                    </div>
                    <div class=\"btn-border\">
                        <div class=\"btn-icon\">
                        +
                        </div>
                    </div>
                </div>
            </div>
        </div>";

    //concatenate strings
    private $experience_form = "";
    private $education_form = "";
    private $skills_form = "";
    private $additional_form = "";

    private $tmp_x = "";
    private $tmp_e = "";
    private $tmp_l = "";
    private $tmp_s = "";
    private $tmp_a = "";

    private $count_tx = 0;
    private $count_te = 0;
    private $count_tl = 0;
    private $count_ts = 0;
    private $count_ta = 0;

    // methods
    function fetchData($host, $db_user, $db_pass, $db_name)
    {
        mysqli_report(MYSQLI_REPORT_STRICT);
        try
        {
            $connection = new mysqli($host, $db_user, $db_pass, $db_name);
            if ($connection->connect_errno != 0)
            {
                throw new Exception(mysqli_connect_errno());
            } else
            {
                // table 2
                $table_experience = $connection->query("SELECT e.job, e.employer, e.start_job, e.end_job, c.locality As job_city, e.description As job_description from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join experiences e on a.id_applicants = e.id_applicants where u.id_user='{$_SESSION['id_user']}'");
                if (!$table_experience)
                {
                    throw new Exception($connection->error);
                }
                $this->count_tx = $table_experience->num_rows;
                $assoc_tx = $table_experience->fetch_assoc();

                // table 3
                $table_education = $connection->query("SELECT s.name_school, s.specialization, s.start_learning, s.end_learning, c.locality As school_city, s.description As school_description from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join schools s on a.id_applicants=s.id_applicants where u.id_user='{$_SESSION['id_user']}'");
                if (!$table_education)
                {
                    throw new Exception($connection->error);
                }
                $this->count_te = $table_education->num_rows;
                $assoc_te = $table_education->fetch_assoc();

                // table 4.1
                $table_lang = $connection->query("SELECT la.language FROM users u join applicants a on u.id_user=a.id_user join knowledge k on a.id_applicants=k.id_applicants join levels le on k.id_level=le.id_level JOIN languages la on k.id_language=la.id_language where u.id_user = '{$_SESSION['id_user']}'");
                $table_lang_level = $connection->query("SELECT le.id_level FROM users u join applicants a on u.id_user=a.id_user join knowledge k on a.id_applicants=k.id_applicants join levels le on k.id_level=le.id_level JOIN languages la on k.id_language=la.id_language where u.id_user = '{$_SESSION['id_user']}'");
                if (!$table_lang || !$table_lang_level)
                {
                    throw new Exception($connection->error);
                }
                $this->count_tl = $table_lang->num_rows;
                while ( $assoc_tl = $table_lang->fetch_assoc())
                {
                    while ((int)$assoc_tll = $table_lang_level->fetch_assoc())
                        foreach ($assoc_tl as $key=>$value)
                        {
                            foreach ($assoc_tll as $keyL=>$valueL)
                            {
                                $this->tmp_l = $this->tmp_l . $this->skills_form_mux1 . $value . $this->skills_form_p2 . $valueL . $this->skills_form_p3;
                            }
                        }
                }

                // table 4.2
                $table_skills = $connection->query("SELECT s.sience, le.id_level FROM users u join applicants a on u.id_user=a.id_user join holders k on a.id_applicants=k.id_applicants join levels le on k.id_level=le.id_level join holders h on le.id_level=h.id_level join skills s on s.id_skill=h.id_skill where u.id_user = '{$_SESSION['id_user']}'");
                $table_skills_level = $connection->query("SELECT le.id_level FROM users u join applicants a on u.id_user=a.id_user join holders k on a.id_applicants=k.id_applicants join levels le on k.id_level=le.id_level join holders h on le.id_level=h.id_level join skills s on s.id_skill=h.id_skill where u.id_user = '{$_SESSION['id_user']}'");
                if (!$table_skills || !$table_skills_level)
                {
                    throw new Exception($connection->error);
                }
                $this->count_ts = $table_skills->num_rows;
                while ($assoc_ts = $table_skills->fetch_assoc())
                {
                    while ((int)$assoc_tsl = $table_skills_level->fetch_assoc())
                    foreach ($assoc_ts as $key=>$value)
                    {
                        foreach ($assoc_tsl as $keyL=>$valueL)
                        {
                            $this->tmp_s = $this->tmp_s . $this->skills_form_mux3 . $value . $this->skills_form_p4 . $valueL . $this->skills_form_p5;
                        }
                    }
                }

                // table 5
                $table_additional = $connection->query("SELECT cv.description As cv_description, cl.description As cl_description, certifications.descriptions As cert_descriptions, t.training, t.description As course_description from users u join applicants a on u.id_user=a.id_user join cv on a.id_applicants=cv.id_applicants join certifications on a.id_applicants=certifications.id_applicants join training t on a.id_applicants=t.id_applicants join applications ap on a.id_applicants=ap.id_applicants join cl on ap.id_application=cl.id_application where u.id_user='{$_SESSION['id_user']}'");
                if (!$table_additional)
                {
                    throw new Exception($connection->error);
                }
                $this->count_ta = $table_additional->num_rows;
                $assoc_ta = $table_additional->fetch_assoc();
            }

            $connection->close();
        }
        catch (Exception $e)
        {
            echo "Server error! Please try again later. Err: ".$e;
        }
    }

    function displayExperience()
    {
        echo $this->experience_form_p1;
    }
    function displayEducation()
    {
        echo $this->education_form_p1;
    }

    function displaySkills()
    {
        $this->skills_form = $this->skills_form_p1. $this->tmp_l . $this->skills_form_mux2. $this->tmp_s . $this->skills_form_mux4;
        echo $this->skills_form;
    }
    function displayAdditional()
    {
        echo $this->additional_form_p1;
    }




}