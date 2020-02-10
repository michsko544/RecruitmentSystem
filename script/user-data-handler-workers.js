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

const addPersonalData = ({firstName, lastName, phone, country, city}) => {
    let sform = document.querySelector("#sform-1");
    let newDiv = document.createRange().createContextualFragment(
        `<div class="form-row">
            <label for="first-name">First name</label>
            <div class="diplay-input">${firstName}</div>
            
        </div>
        <div class="form-row">
            <label for="last-name">Last name</label>
            <div class="diplay-input">${lastName}</div>
            
        </div>
        <div class="form-row">
            <label for="phone-num">Phone number</label>
            <div class="diplay-input">${phone}</div>
            
        </div>
        <div class="form-row">
            <label for="residence-country">Your country</label>
            <div class="diplay-input">${country}</div>
            
        </div>
        <div class="form-row">
            <label for="residence-city">Your city</label>
            <div class="diplay-input">${city}</div>
            
        </div>`
    );
    sform.appendChild(newDiv);
}

let countE = 0;
const addExperience = ({jobTitle, employer, startDate, endDate, city, description}) => {
    let form = document.querySelector("#sform-2");
    let newDiv = document.createRange().createContextualFragment(
        `${countE===0 ? "" : "<br/><br/><br/>"}<div class="form-row">
            <label for="job-title">Job title</label>
            <div class="diplay-input">${jobTitle || ""}</div>
            
        </div>
        <div class="form-row">
            <label for="employer">Employer</label>
            <div class="diplay-input">${employer || ""}</div>
            
        </div>
        <div class="form-row">
            <label for="start-end-date">Start & End date</label>
                <div id="start-exp-${countE}" class="diplay-input">${startDate} / ${endDate}</div>
        </div>
        <div class="form-row">
            <label for="job-city">City</label>
            <div class="diplay-input">${city || ""}</div>
            
        </div>
        <div class="form-row">
            <label for="job-description">Description</label>
            <div class="diplay-input">${description || ""}</div>
            
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
                <div class="diplay-input">${lang || ""}</div>
                
                <div class="degree">
                    <div>${level || 1}</div>
                    <div class="limit">/5</div>
                </div>
            </div>`
        );
        firstLanguage = false;
    } else {
        newDiv = document.createRange().createContextualFragment(
            `<div class="form-row">
                <div class="diplay-input">${lang || ""}</div>
                
                <div class="degree">
                    <div>${level || 1}</div>
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
                <div class="diplay-input">${skill || ""}</div>
                
                <div class="degree">
                    <div>${level || 1}</div>
                    <div class="limit">/5</div>
                </div>
            </div>`
        );
        firstSkill = false;
    } else {
        newDiv = document.createRange().createContextualFragment(
            `<div class="form-row">
                <div class="diplay-input">${skill || ""}</div>
                
                <div class="degree">
                    <div>${level || 1}</div>
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
            <div class="diplay-input">${schoolName || ""}</div>
            
        </div>
        <div class="form-row">
            <label for="specialization">Specialization</label>
            <div class="diplay-input">${specialization || ""}</div>
            
        </div>
        <div class="form-row">
            <label for="start-end-date">Start & End date</label>
            <div id="start-school-${countS}" class="diplay-input">${startDate} / ${endDate}</div>
        </div>
        <div class="form-row">
            <label for="school-city">City</label>
            <div class="diplay-input">${city || ""}</div>
            
        </div>
        <div class="form-row">
            <label for="school-description">Description</label>
            <div class="diplay-input">${description || ""}<div>
            
        </div>`
    );
    form.appendChild(newDiv);
    ++countS;
}

const addCV = ({cv}) => {
    let upload = document.querySelectorAll(".upload-div")
    let newDiv = document.createRange().createContextualFragment(
        `<div class="form-row">
            <label for="cv-file">Curriculum vitae</label>
            <div  class="diplay-input">${cv || ""}</div>
            <div class="btn-x"></div>
        </div>`
    );
    upload[0].parentNode.insertBefore(newDiv, upload[0]);
}

let firstCert = true;
const addCertificate = ({cert}) => {
    if(cert){
        if(firstCert){
            let upload = document.querySelectorAll(".upload-div")
            let newDiv = document.createRange().createContextualFragment(
                `<div class="form-row">
                    <label for="certificate-file">Certificates</label>
                    <div class="diplay-input">${cert}</div>
                    <div class="btn-x"></div>
                </div>`
            );
            upload[1].parentNode.insertBefore(newDiv, upload[1]);
            firstCert=false;
        } else {
            let upload = document.querySelectorAll(".upload-div")
            let newDiv = document.createRange().createContextualFragment(
                `<div class="form-row">
                    <div class="diplay-input">${cert}</div>
                    <div class="btn-x"></div>
                </div>`
            );
            upload[1].parentNode.insertBefore(newDiv, upload[1]);
        }
    }
}

const addCL = ({cl}) => {

        let upload = document.querySelectorAll(".upload-div")
        let newDiv = document.createRange().createContextualFragment(
            `<div class="form-row">
                <label for="lm-file">Cover Letter</label>
                <div class="diplay-input">${cl}</div>
                
                <div class="btn-x"></div>
            </div>`
        );
        upload[2].parentNode.insertBefore(newDiv, upload[2]);
}

let countC = 0;
let firstCourse = true;
const addCourse = ({course}) => {
    let form = document.getElementById("sform-5");
    let newDiv;
    if(firstCourse){
        newDiv = document.createRange().createContextualFragment(
            `<div class="form-row">
                <label for="course">Courses</label>
                <div class="diplay-input">${course || ""}</div>
                
            </div>`
        );
        firstCourse = false;
    } else {
        newDiv = document.createRange().createContextualFragment(
            `<div class="form-row">
                <div class="diplay-input">${course || ""}</div>
                
            </div>`
        );
    }
    form.appendChild(newDiv);
    ++countC;
}

const addStageBtn = () => {
    let container = document.querySelector("#container");
    var url_string = window.location.href;
    var url = new URL(url_string);
    let aid = url.searchParams.get("aid");
    let uid = url.searchParams.get("uid");
    let newDiv = document.createRange().createContextualFragment(
        `<a href="add-stage.php?aid=${aid}&uid=${uid}">   
            <div class="list-row bottom-row left-btn" id="btn-add-stage">
                <div class="btn-add ">
                    <div class="btn-border">
                        <div class="btn-icon">
                            +
                        </div>
                    </div>
                    <div class="btn-text">
                        Add stage
                    </div>
                </div>
            </div>
        </a>`);
    container.appendChild(newDiv);
    console.log("added",container,newDiv)
};

const viewStageBtn = () => {
    let container = document.querySelector("#container");
    var url_string = window.location.href;
    var url = new URL(url_string);
    let aid = url.searchParams.get("aid");
    let uid = url.searchParams.get("uid");
    let newDiv = document.createRange().createContextualFragment(
        `<a href="stages.php?aid=${aid}&uid=${uid}">  
            <div class="list-row bottom-row right-btn" id="btn-view-stage">
                <div class="btn-add ">
                    <div class="btn-border">
                        <div class="btn-icon" id="btn-list"></div>
                    </div>
                    <div class="btn-text">
                        View stages
                    </div>
                </div>
            </div>
        </a>`);
    container.appendChild(newDiv);
    console.log("added",container,newDiv)
};