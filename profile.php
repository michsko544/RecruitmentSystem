<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recruitment System - Profile</title>
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <link rel="stylesheet" href="/font/stylesheet.css" type="text/css" charset="utf-8" />
</head>
<body>
    <nav>
        <div class="nav-bar">
            <div class="logo-nav">myCompany</div>
            <ul class="nav-links">
                <li id="menu">Menu</li>
                <li><a href="profile.php">My profile</a></li>
                <li><a href="applications.php">Applications</a></li>
                <li><a href="#">Replies</a></li>
                <li><a href="php/log_in/log_out.php">Sign out</a></li>
            </ul>
            <div id="btn-burger" class="btn-nav">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
        </div>
        <div id="nav-help"></div>
    </nav>
    <div id="container">
        <div class="small-title">
            Your profile
        </div>
        <div class="list-row">
            <div class="title-element">Personal data</div>
            <div class="btn-element">
                <div class="btn-unwrap">
                    <div class="line1"></div>
                    <div class="line2"></div>
                </div>
            </div>
        </div>
        <div class="list-row hide" id="personal-data">
            <div class="element-wrapper">
                <div class="form-row">
                    <label for="first-name">First name</label>
                    <input type="text" name="first-name">
                </div>
                <div class="form-row">
                    <label for="last-name">Last name</label>
                    <input type="text" name="last-name">
                </div>
                <div class="form-row">
                    <label for="phone-num">Phone number</label>
                    <input type="tel" name="phone-num">
                </div>
                <div class="form-row">
                    <label for="residence-country">Your country</label>
                    <input type="text" name="residence-country">
                </div>
                <div class="form-row">
                    <label for="residence-city">Your city</label>
                    <input type="text" name="residence-city">
                </div>
            </div>
        </div>
        <div class="list-row">
            <div class="title-element">Experience</div>
            <div class="btn-element">
                <div class="btn-unwrap">
                    <div class="line1"></div>
                    <div class="line2"></div>
                </div>
            </div>
        </div>
        <div class="list-row hide" id="experience">
            <div class="element-wrapper">
                <div class="form-row">
                    <div class="checkbox">
                        <input type="checkbox" name="no-experience" id="no-experience">I don't  have any experience
                    </div>
                </div>
                <div class="form-row">
                    <label for="job-title">Job title</label>
                    <input type="text" name="job-title-0">
                </div>
                <div class="form-row">
                    <label for="employer">Employer</label>
                    <input type="text" name="employer-0">
                </div>
                <div class="form-row">
                    <label for="start-end-date">Start & End date</label>
                    <div class="date">
                        <input type="text" id="datej1" class="start-date" name="start-date-0">
                        <input type="text" id="datej2" class="end-date" name="end-date-0">
                    </div>
                </div>
                <div class="form-row">
                    <label for="job-city">City</label>
                    <input type="text" name="job-city-0">
                </div>
                <div class="form-row">
                    <label for="job-description">Description</label>
                    <textarea name="job-description-0" cols="35" rows="4"></textarea>
                </div>
                <div class="btn-add" id="btn-experiance">
                    <div class="btn-text">
                        Add employment <!--TODO var exp-count -->
                    </div>
                    <div class="btn-border">
                        <div class="btn-icon">
                        +
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-row">
            <div class="title-element">Education</div>
            <div class="btn-element">
                <div class="btn-unwrap">
                    <div class="line1"></div>
                    <div class="line2"></div>
                </div>
            </div>
        </div>
        <div class="list-row hide" id="education">
            <div class="element-wrapper">
                <div class="form-row">
                    <label for="school">School</label>
                    <input type="text" name="school-0" required>
                </div>
                <div class="form-row">
                    <label for="specialization">Specialization</label>
                    <input type="text" name="specialization-0" required>
                </div>
                <div class="form-row">
                    <label for="start-end-date">Start & End date</label>
                    <div class="date">
                        <input type="text" class="start-date" name="school-start-date-0" required>
                        <input type="text" class="end-date" name="school-end-date-0" required>
                    </div>
                </div>
                <div class="form-row">
                    <label for="school-city">City</label>
                    <input type="text" name="school-city-0" required>
                </div>
                <div class="form-row">
                    <label for="school-description">Description</label>
                    <textarea name="school-description-0" cols="35" rows="4"></textarea>
                </div>
                <div class="btn-add" id="btn-school">
                    <div class="btn-text">
                        Add school <!-- TODO var school-count -->
                    </div>
                    <div class="btn-border">
                        <div class="btn-icon">
                        +
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-row">
            <div class="title-element">Skills</div>
            <div class="btn-element">
                <div class="btn-unwrap">
                    <div class="line1"></div>
                    <div class="line2"></div>
                </div>
            </div>
        </div>
        <div class="list-row hide" id="skills">
            <div class="element-wrapper">
                <div class="form-row relative">
                    <label for="languages">Languages</label>
                    <input type="text" name="languages-0" placeholder="German" required>
                <div class="degree">
                    <input type="number" name="language-level-0" min=1 max=5 placeholder=1>
                        <div class="limit">/5</div>
                    </div>
                </div>
                <div class="btn-add" id="btn-language">
                    <div class="btn-text">
                        Add language
                    </div>
                    <div class="btn-border">
                        <div class="btn-icon">
                        +
                        </div>
                    </div>
                </div>
                <div class="form-row relative">
                    <label for="skills">Skills</label>
                    <input type="text" name="skills-0" placeholder="Marketing" required>
                    <div class="degree">
                        <input type="number" name="skill-level-0" min=1 max=5 placeholder=1>
                        <div class="limit">/5</div>
                    </div>
                </div>
                <div class="btn-add" id="btn-skill">
                    <div class="btn-text">
                        Add skill
                    </div>
                    <div class="btn-border">
                        <div class="btn-icon">
                        +
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-row">
            <div class="title-element">Addition</div>
            <div class="btn-element">
                <div class="btn-unwrap">
                    <div class="line1"></div>
                    <div class="line2"></div>
                </div>
            </div>
        </div>
        <div class="list-row hide" id="addition">
            <div class="element-wrapper">
                <div class="form-row">
                    <label for="cv-file">Curriculum vitae</label>
                    <div class="upload">
                        <input type="file" name="cv-file" class="inputfile" accept="application/pdf">
                        <label for="cv-file">Choose a file</label>
                    </div>
                </div>
                <div class="form-row ">
                    <label for="certificate-file">Certificates</label>
                    <div class="upload">
                        <input type="file" name="certificate-file-0" class="inputfile"      accept="application/pdf" data-multiple-caption="{count} files selected"     multiple>
                        <label>Choose a file</label>
                    </div>
                </div>
                <div class="form-row">
                    <label for="lm-file">Cover Letter</label>
                        <div class="upload">
                        <input type="file" name="lm-file" class="inputfile" accept="application/pdf" data-multiple-caption="{count} files selected" multiple>
                        <label>Choose a file</label>
                    </div>
                </div>
                <div class="form-row">
                    <label for="course">Courses</label>
                    <input type="text" name="course-0" placeholder="e.g. Google Internet Revolutions">
                </div>
                <div class="btn-add" id="btn-course">
                    <div class="btn-text">
                        Add Course <!-- TODO var docs-count -->
                    </div>
                    <div class="btn-border">
                        <div class="btn-icon">
                        +
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="script/main.js"></script>
<script src="script/burger.js"></script>
<script src="script/calendar.js"></script>
<script src="script/sign-up.js"></script>
<script src="script/profile.js"></script>
</html>