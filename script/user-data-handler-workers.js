var buttons=document.getElementsByClassName("btn");

const highlightLabel = function(elem) { //id inputa
    
    if(elem.className!=="inputfile") {
        elem.addEventListener("focus", function(){
            //console.log(elem.parentNode.parentNode.children[0]);
            elem.parentNode.className==="form-row" 
            ?
                elem.parentNode.children[0].classList.toggle("cyan-color") //dla daty dwa parentNode
                :
                elem.parentNode.parentNode.children[0].classList.toggle("cyan-color");
        });
        elem.addEventListener("focusout", function(){
            //console.log(elem.parentNode.parentNode.children[0]);
            elem.parentNode.className==="form-row" 
            ?
                elem.parentNode.children[0].classList.toggle("cyan-color") //dla daty dwa parentNode
                :
                elem.parentNode.parentNode.children[0].classList.toggle("cyan-color");
        });
    }
}

const addHighlightEvents = () => {
    console.log("loading new events");
    const inputs = document.querySelectorAll("input");
    const textareas = document.querySelectorAll("textarea");
    const selects = document.querySelectorAll("select");
    inputs.forEach( elem => {
        //console.dir(elem);
        highlightLabel(elem);
        return true;
    });
    textareas.forEach( elem => {
        highlightLabel(elem);
        return true;
    });
    selects.forEach( elem => {
        highlightLabel(elem);
        return true;
    });
    return true;
}

//addHighlightEvents();

const addPersonalData = ({firstName, lastName, phone, country, city}) => {
    let br = document.querySelector("#break-1");
    let newDiv = document.createRange().createContextualFragment(
        `<div class="form-row">
            <label for="first-name">First name</label>
            <input type="text" name="first-name" value="${firstName}">
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="last-name">Last name</label>
            <input type="text" name="last-name" value="${lastName}">
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="phone-num">Phone number</label>
            <input type="tel" name="phone-num" value="${phone}">
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="residence-country">Your country</label>
            <input type="text" name="residence-country" value="${country}">
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="residence-city">Your city</label>
            <input type="text" name="residence-city" value="${city}">
            <div class="underline"></div>
        </div>`
    );
    br.parentNode.insertBefore(newDiv, br);
}

let countE = 0;
const addExperience = ({jobTitle, employer, startDate, endDate, city, description}) => {
    let form = document.querySelector("#sform-2");
    let newDiv = document.createRange().createContextualFragment(
        `${countE===0 ? "" : "<br/><br/><br/>"}<div class="form-row">
            <label for="job-title">Job title</label>
            <input type="text" name="job-title-${countE}" placeholder="Waiter" value="${jobTitle || ""}" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="employer">Employer</label>
            <input type="text" name="employer-${countE}" placeholder="Italian Restaurant London" value="${employer || ""}" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="start-end-date">Start & End date</label>
            <div class="date">
                <input type="text" id="start-exp-${countE}" class="start-date"  name="start-date-${countE}" placeholder="29-03-2019" required>
                <input type="text" id="end-exp-${countE}" class="end-date" name="end-date-${countE}" placeholder="13-12-2019" required>
            </div>
        </div>
        <div class="form-row">
            <label for="job-city">City</label>
            <input type="text" name="job-city-${countE}" placeholder="London" value="${city || ""}" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="job-description">Description</label>
            <textarea name="job-description-${countE}" cols="35" rows="4" placeholder="e.g. waitressing,preparing venue for events, taking care of restaurant clarity, making basic drinks, brewing coffee" required>${description || ""}</textarea>
            <div class="underlineTA"></div>
        </div>`
    );
    form.appendChild(newDiv);
    ++countE;
}


let countL = 0;
let firstLanguage = true;
const addLanguage = ({lang, level}) => {
    let brk = document.querySelector("#sform-4").querySelector(".break");
    let newDiv;
    if(firstLanguage){
        newDiv = document.createRange().createContextualFragment(
            `<div class="form-row">
                <label for="languages">Languages</label>
                <input type="text" name="languages-${countL}" placeholder="German" value="${lang || ""}" required>
                <div class="underline"></div>
                <div class="degree">
                    <input type="number" name="language-level-${countL}" min=1 max=5 placeholder=1 value="${level || 1}">
                    <div class="limit">/5</div>
                </div>
            </div>`
        );
        firstLanguage = false;
    } else {
        newDiv = document.createRange().createContextualFragment(
            `<div class="form-row">
                <input type="text" name="languages-${countL}" placeholder="German" value="${lang || ""}" required>
                <div class="underline"></div>
                <div class="degree">
                    <input type="number" name="language-level-${countL}" min=1 max=5 placeholder=1 value="${level || 1}">
                    <div class="limit">/5</div>
                </div>
            </div>`
        );
    }
    brk.parentNode.insertBefore(newDiv,brk);
    ++countL;
}


let countSk = 0;
let firstSkill = true;
const addSkill = ({skill, level}) => {
    let form = document.querySelector("#sform-4");
    let newDiv;
    if(firstSkill){
        newDiv = document.createRange().createContextualFragment(
            `<div class="form-row">
                <label for="skills">Skills</label>
                <input type="text" name="skills-${countSk}" placeholder="Marketing" value="${skill || ""}"required>
                <div class="underline"></div>
                <div class="degree">
                    <input type="number" name="skill-level-${countSk}" min=1 max=5 placeholder=1 value="${level || 1}">
                    <div class="limit">/5</div>
                </div>
            </div>`
        );
        firstSkill = false;
    } else {
        newDiv = document.createRange().createContextualFragment(
            `<div class="form-row">
                <input type="text" name="skills-${countSk}" placeholder="Marketing" value="${skill || ""}"required>
                <div class="underline"></div>
                <div class="degree">
                    <input type="number" name="skill-level-${countSk}" min=1 max=5 placeholder=1 value="${level || 1}">
                    <div class="limit">/5</div>
                </div>
            </div>`
        );
    }
    form.appendChild(newDiv);
    ++countSk;
}


let countS = 0;
const addSchool = ({schoolName, specialization, startDate, endDate, city, description}) => {
    let form = document.getElementById("sform-3");
    let newDiv = document.createRange().createContextualFragment(
        `${countS===0 ? "" : "<br/><br/><br/>"}<div class="form-row">
            <label for="school">School</label>
            <input type="text" name="school-${countS}" placeholder="Silesian University of Technology" value="${schoolName || ""}"required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="specialization">Specialization</label>
            <input type="text" name="specialization-${countS}" placeholder="Teleinformatics" value="${specialization || ""}" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="start-end-date">Start & End date</label>
            <div class="date">
                <input type="text" id="start-school-${countS}" class="start-date" name="school-start-date-${countS}" placeholder="29-03-2019" required>
                <input type="text" id="end-school-${countS}" class="end-date" name="school-end-date-${countS}" placeholder="13-12-2019" required>
            </div>
        </div>
        <div class="form-row">
            <label for="school-city">City</label>
            <input type="text" name="school-city-${countS}" placeholder="Gliwice" value="${city || ""}" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="school-description">Description</label>
            <textarea name="school-description-${countS}" cols="35" rows="4" placeholder="e.g.  programming, data analysing, network designing, microprocessors coding">${description || ""}</textarea>
            <div class="underlineTA"></div>
        </div>`
    );
    form.appendChild(newDiv);
    ++countS;
}


const addCV = ({cv}) => {
    let upload = document.querySelectorAll(".upload")
    let newDiv = document.createRange().createContextualFragment(
        `<div class="form-row">
            <input type="text" name="cv" value="${cv || ""}" required>
            <div class="underline"></div>
            <div class="btn-x"></div>
        </div>`
    );
    upload[0].parentNode.insertBefore(newDiv, upload[0]);
}

const addCertificate = ({cert}) => {
    if(cert){
        let upload = document.querySelectorAll(".upload")
        let newDiv = document.createRange().createContextualFragment(
            `<div class="form-row">
                <input type="text" name="certificate" value="${cert || ""}">
                <div class="underline"></div>
                <div class="btn-x"></div>
            </div>`
        );
        upload[1].parentNode.insertBefore(newDiv, upload[1]);
    }
}

/*const addCL = ({cl}) => {
    if(cl){
        let upload = document.querySelectorAll(".upload")
        let newDiv = document.createRange().createContextualFragment(
            `<div class="form-row">
                <input type="text" name="cl" value="${cl}">
                <div class="underline"></div>
                <div class="btn-x"></div>
            </div>`
        );
        upload[2].parentNode.insertBefore(newDiv, upload[2]);
    }
}*/

let countC = 0;
let firstCourse = true;
const addCourse = ({course}) => {
    let form = document.getElementById("sform-5");
    let newDiv;
    if(firstCourse){
        newDiv = document.createRange().createContextualFragment(
            `<div class="form-row">
                <label for="course">Courses</label>
                <input type="text" name="course-${countC}" placeholder="e.g. Google Internet Revolutions" value="${course || ""}">
                <div class="underline"></div>
            </div>`
        );
        firstCourse = false;
    } else {
        newDiv = document.createRange().createContextualFragment(
            `<div class="form-row">
                <input type="text" name="course-${countC}" placeholder="e.g. Google Internet Revolutions" value="${course || ""}">
                <div class="underline"></div>
            </div>`
        );
    }
    form.appendChild(newDiv);
    ++countC;
}