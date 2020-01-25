let beenChanged = false;
const addSaveChangesBtn = () => {
    beenChanged = true;
    if(beenChanged){
        console.log("przycisk zostal klikniety albo dodales event");
        const container = document.querySelector("#container");
        const newDiv = document.createRange().createContextualFragment(
            `<div class="list-row bottom-row" id="btn-profile">
                <div class="btn-add ">
                    <div class="btn-border">
                        <div class="btn-icon">
                            +
                        </div>
                    </div>
                    <div class="btn-text">
                            Confirm changes
                    </div>
                </div>
            </div>`
        );
        container.appendChild(newDiv);
    }
};

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

const addOnChangeEventsToDisplayBtn = (input) => {
    if(input){
        console.log("loading new onchange events");
        input.addEventListener("change", addSaveChangesBtn);
        return true;
    } else {
        console.log("loading onchange events to all inputs");
        const forms = document.querySelectorAll("form");
        forms.forEach(elem => {
            const inputs = elem.querySelectorAll("input");
            const textareas = elem.querySelectorAll("textarea");
            const selects = elem.querySelectorAll("select");
            inputs.forEach( elem => {
                elem.addEventListener("change", addSaveChangesBtn);
                //highlightLabel(elem);
            });
            textareas.forEach( elem => {
                elem.addEventListener("change", addSaveChangesBtn);
                //highlightLabel(elem);
            });
            selects.forEach( elem => {
                elem.addEventListener("change", addSaveChangesBtn);
                //highlightLabel(elem);
            });
            return true;
        });
        
    }
}

//addHighlightEvents();

calendar("exp-0");
calendar("school-0");

document.getElementById("no-experience").addEventListener("click", function(){
    const form = this.parentNode.parentNode.parentNode.id;
    if(this.checked===true){
        document.getElementById(form).querySelectorAll('div.form-row').forEach(element=>{
            if(element.children[1]!==undefined){
                if(element.children[1].className!=="date") {
                    element.children[1].required=false;
                } else {
                    element.children[1].children[0].required=false;
                    element.children[1].children[1].required=false;
                }
            }
        }); 

        hideDiv("btn-experience");
    } else {
        document.getElementById(form).querySelectorAll('div.form-row').forEach(element=>{
            if(element.children[1]!==undefined){
                if(element.children[1].className!=="date") {
                    element.children[1].required=true;
                } else {
                    element.children[1].children[0].required=true;
                    element.children[1].children[1].required=true;
                }
            } 
        }); 

        showDiv("btn-experience--hidden");
    }
});

const addPersonalData = ({firstName, lastName, phone, country, city}) => {
    let br = document.querySelector("#break-1");
    let newDiv = document.createRange().createContextualFragment(
        `<div class="form-row">
            <label for="first-name">First name</label>
            <input type="text" class="input-0" name="first-name" value="${firstName}">
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="last-name">Last name</label>
            <input type="text" class="input-0" name="last-name" value="${lastName}">
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="phone-num">Phone number</label>
            <input type="tel" class="input-0" name="phone-num" value="${phone}">
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="residence-country">Your country</label>
            <input type="text" class="input-0" name="residence-country" value="${country}">
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="residence-city">Your city</label>
            <input type="text" class="input-0" name="residence-city" value="${city}">
            <div class="underline"></div>
        </div>`
    );
    br.parentNode.insertBefore(newDiv, br);
    br.parentNode.querySelectorAll(`.input-0`).forEach(elem=>{
        addOnChangeEventsToDisplayBtn(elem);
    });
}

let countE = 0;
const addExperience = ({jobTitle, employer, startDate, endDate, city, description}) => {
    let btn = document.getElementById("btn-experience");
    let newDiv = document.createRange().createContextualFragment(
        `${countE===0 ? "" : "<br/><br/><br/>"}<div class="form-row">
            <label for="job-title">Job title</label>
            <input type="text" class="input-${countE}" name="job-title-${countE}" placeholder="Waiter" value="${jobTitle || ""}" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="employer">Employer</label>
            <input type="text" class="input-${countE}" name="employer-${countE}" placeholder="Italian Restaurant London" value="${employer || ""}" required>
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
            <input type="text" class="input-${countE}" name="job-city-${countE}" placeholder="London" value="${city || ""}" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="job-description">Description</label>
            <textarea class="input-${countE}" name="job-description-${countE}" cols="35" rows="4" placeholder="e.g. waitressing,preparing venue for events, taking care of restaurant clarity, making basic drinks, brewing coffee" required>${description || ""}</textarea>
            <div class="underlineTA"></div>
        </div>`
    );

    btn.parentNode.insertBefore(newDiv, btn);
    calendar(`exp-${countE}`);
    
    if(startDate){
        let date = new Date(new Number(startDate.slice(0,4)),new Number(startDate.slice(5,7))-1,new Number(startDate.slice(8,10)));
        console.log(date);
        $(`#start-exp-${countE}`).datepicker("setDate", date );
    }

    btn.parentNode.querySelectorAll(`.input-${countE}`).forEach(elem=>{
        addOnChangeEventsToDisplayBtn(elem);
    });
    // console.log(btn.parentNode.querySelector(`#start-exp-${countE}`));
    // addOnChangeEventsToDisplayBtn(btn.parentNode.querySelector(`#start-exp-${countE}`));
    // addOnChangeEventsToDisplayBtn(btn.parentNode.querySelector(`#end-exp-${countE}`));
    ++countE;
}

document.getElementById("btn-experience").addEventListener("click", addExperience);

let countL = 0;
let firstLanguage = true;
const addLanguage = ({lang, level}) => {
    let btn = document.getElementById("btn-language");
    let newDiv 

        newDiv = document.createRange().createContextualFragment(
            `<div class="form-row">
                ${firstLanguage?'<label for="languages">Languages</label>' : ""}
                <input type="text" class="input-${countL}" name="languages-${countL}" placeholder="German" value="${lang || ""}" required>
                <div class="underline"></div>
                <div class="degree">
                    <input type="number" class="input-${countL}" name="language-level-${countL}" min=1 max=5 placeholder=1 value="${level || 1}">
                    <div class="limit">/5</div>
                </div>
            </div>`
        );
        firstLanguage = false;
    
    btn.parentNode.insertBefore(newDiv, btn);
    btn.parentNode.querySelectorAll(`.input-${countL}`).forEach(elem=>{
        addOnChangeEventsToDisplayBtn(elem);
    });
    ++countL;
    //addHighlightEvents();
}

document.getElementById("btn-language").addEventListener("click", addLanguage);

let countSk = 0;
let firstSkill = true;
const addSkill = ({skill, level}) => {
    let btn = document.getElementById("btn-skill");
    let newDiv;
        newDiv = document.createRange().createContextualFragment(
            `<div class="form-row">
                ${firstSkill?'<label for="skills">Skills</label>' : ""}
                <input type="text" class="input-${countSk}" name="skills-${countSk}" placeholder="Marketing" value="${skill || ""}"required>
                <div class="underline"></div>
                <div class="degree">
                    <input type="number" class="input-${countSk}" name="skill-level-${countSk}" min=1 max=5 placeholder=1 value="${level || 1}">
                    <div class="limit">/5</div>
                </div>
            </div>`
        );
        firstSkill = false;
    btn.parentNode.insertBefore(newDiv, btn);
    btn.parentNode.querySelectorAll(`.input-${countSk}`).forEach(elem=>{
        addOnChangeEventsToDisplayBtn(elem);
    });

    ++countSk;
    //addHighlightEvents();
}

document.getElementById("btn-skill").addEventListener("click", addSkill);

let countS = 0;
const addSchool = ({schoolName, specialization, startDate, endDate, city, description}) => {
    let btn = document.getElementById("btn-school");
    let newDiv = document.createRange().createContextualFragment(
        `${countS===0 ? "" : "<br/><br/><br/>"}<div class="form-row">
            <label for="school">School</label>
            <input type="text" class="input-${countS}" name="school-${countS}" placeholder="Silesian University of Technology" value="${schoolName || ""}"required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="specialization">Specialization</label>
            <input type="text" class="input-${countS}" name="specialization-${countS}" placeholder="Teleinformatics" value="${specialization || ""}" required>
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
            <input type="text" class="input-${countS}" name="school-city-${countS}" placeholder="Gliwice" value="${city || ""}" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="school-description">Description</label>
            <textarea class="input-${countS}" name="school-description-${countS}" cols="35" rows="4" placeholder="e.g.  programming, data analysing, network designing, microprocessors coding">${description || ""}</textarea>
            <div class="underlineTA"></div>
        </div>`
    );
    btn.parentNode.insertBefore(newDiv, btn);
    calendar(`school-${countS}`);
    btn.parentNode.querySelectorAll(`.input-${countS}`).forEach(elem=>{
        addOnChangeEventsToDisplayBtn(elem);
    });
    ++countS;
    //addHighlightEvents();
}

document.getElementById("btn-school").addEventListener("click", addSchool);

const addCV = ({cv}) => {
    let upload = document.querySelectorAll(".upload")
    let newDiv = document.createRange().createContextualFragment(
        `<div class="form-row">
            <div class="display-input">${cv || ""}</div>
            <div class="btn-x"></div>
        </div>`
    );
    upload[0].parentNode.insertBefore(newDiv, upload[0]);
    addOnChangeEventsToDisplayBtn(upload[0].querySelector("input"));
}

const addCertificate = ({cert}) => {
    let upload = document.querySelectorAll(".upload")
    let newDiv = document.createRange().createContextualFragment(
        `<div class="form-row">
            <div class="display-input">${cert || ""}</div>
            <div class="btn-x"></div>
        </div>`
    );
    upload[1].parentNode.insertBefore(newDiv, upload[1]);
    addOnChangeEventsToDisplayBtn(upload[1].querySelector("input"));
}

let countC = 0;
let firstCourse = true;
const addCourse = ({course}) => {
    let btn = document.getElementById("btn-course");
    let newDiv;
        newDiv = document.createRange().createContextualFragment(
            `<div class="form-row">
                ${firstCourse?'<label for="course">Courses</label>' : ""}
                <input type="text" class="input-${countC}" name="course-${countC}" placeholder="e.g. Google Internet Revolutions" value="${course || ""}">
                <div class="underline"></div>
            </div>`
        );
        firstCourse = false;
    btn.parentNode.insertBefore(newDiv, btn);

    //addHighlightEvents();
    btn.parentNode.querySelectorAll(`.input-${countC}`).forEach(elem=>{
        addOnChangeEventsToDisplayBtn(elem);
    });
    ++countC;
}

document.getElementById("btn-course").addEventListener("click", addCourse);