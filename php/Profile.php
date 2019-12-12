<?php


class Profile
{
    /*  TODO display multiple experience values
                                set varGet to $count_tx - 1
                                do magic
                                make it work
                                create loop with echo with whole form and fill it
                                with data according to $i value
                            */
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
            <div class=\"element-wrapper\">
                <div class=\"form-row relative\">
                    <label for=\"languages\">Languages</label>
                    <input type=\"text\" name=\"languages-0\" placeholder=\"German\" value='";

    private $skills_form_p2 = "' required>
                    <div class=\"underline\"></div>
                <div class=\"degree\">
                    <input type=\"number\" name=\"language-level-0\" min=1 max=5 placeholder=1 value=\'";

    private $skills_form_p3 = "'>
                        <div class=\"limit\">/5</div>
                    </div>
                </div>
                <div class=\"btn-add\" id=\"btn-language\">
                    <div class=\"btn-text\">
                        Add language
                    </div>
                    <div class=\"btn-border\">
                        <div class=\"btn-icon\">
                        +
                        </div>
                    </div>
                </div>
                <div class=\"form-row relative\">
                    <label for=\"skills\">Skills</label>
                    <input type=\"text\" name=\"skills-0\" placeholder=\"Marketing\" value='";

    private $skills_form_p4 = "' required>
                    <div class=\"underline\"></div>
                    <div class=\"degree\">
                        <input type=\"number\" name=\"skill-level-0\" min=1 max=5 placeholder=1 value=\'";

    private $skills_form_p5 = "'>
                        <div class=\"limit\">/5</div>
                    </div>
                </div>
                <div class=\"btn-add\" id=\"btn-skill\">
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

    // methods
    function displayExperience()
    {
        echo $this->experience_form_p1;
    }
    function displayEducation()
    {
        echo $this->education_form_p1;
    }
    function displaySkills($getVarLang, $getVarSkill, $lang_table, $skills_table)
    {
        for ($i=0;$i <= $getVarLang;$i++)
        {
            for ($j=0; $j <= $getVarSkill; $j++)
            {
                $this->skills_form = $this->skills_form_p1. $lang_table .$this->skills_form_p2. $lang_table .$this->skills_form_p3. $skills_table .$this->skills_form_p4. $skills_table .$this->skills_form_p5;
            }
        }
        echo $this->skills_form;
    }
    function displayAdditional()
    {
        echo $this->additional_form_p1;
    }




}