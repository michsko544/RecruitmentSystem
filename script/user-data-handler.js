var buttons=document.getElementsByClassName("btn");

const highlightLabel = function(elem) { //id inputa
    
    if(elem.className!=="inputfile") {
        elem.addEventListener("focus", function(){
            console.log(elem.parentNode.parentNode.children[0]);
            elem.parentNode.className==="form-row" 
            ?
                elem.parentNode.children[0].classList.toggle("cyan-color") //dla daty dwa parentNode
                :
                elem.parentNode.parentNode.children[0].classList.toggle("cyan-color");
        });
        elem.addEventListener("focusout", function(){
            console.log(elem.parentNode.parentNode.children[0]);
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
        console.dir(elem);
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

addHighlightEvents();

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

        hideDiv("btn-experiance");
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

        showDiv("btn-experiance--hidden");
    }
});

const addPersonalData = ({}) => {

}

let countE = 0;
const addExperience = ({jobTitle, employer, startDate, endDate, city, description}) => {
    let btn = document.getElementById("btn-experiance");
    let newDiv = document.createRange().createContextualFragment(
        `<div class="form-row">
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
                <input type="text" id="start-exp-${countE}" class="start-date"  name="start-date-${countE}" placeholder="Oct, 2019" required>
                <input type="text" id="end-exp-${countE}" class="end-date" name="end-date-${countE}" placeholder="Nov, 2019" required>
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

    btn.parentNode.insertBefore(newDiv, btn);
    calendar(`exp-${countE}`);
    ++countE;
    addHighlightEvents();
}

document.getElementById("btn-experiance").addEventListener("click", addExperience);

let countL = 0;
let firstLanguage = true;
const addLanguage = ({lang, level}) => {
    let btn = document.getElementById("btn-language");
    let newDiv 
    if(firstLanguage){
        newDiv = document.createRange().createContextualFragment(
            `<div class="form-row">
                <label for="languages">Languages</label>
                <input type="text" name="languages-${countL}" placeholder="German" value="${lang || ""}" required>
                <div class="underline"></div>
                <div class="degree">
                    <input type="number" name="language_level-${countL}" min=1 max=5 placeholder=1 value="${level || 1}">
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
                    <input type="number" name="language_level-${countL}" min=1 max=5 placeholder=1 value="${level || 1}">
                    <div class="limit">/5</div>
                </div>
            </div>`
        );
    }
    btn.parentNode.insertBefore(newDiv, btn);
    ++countL;
    addHighlightEvents();
}

document.getElementById("btn-language").addEventListener("click", addLanguage);

let countSk = 0;
let firstSkill = true;
const addSkill = ({skill, level}) => {
    let btn = document.getElementById("btn-skill");
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
    btn.parentNode.insertBefore(newDiv, btn);
    ++countSk;
    addHighlightEvents();
}

document.getElementById("btn-skill").addEventListener("click", addSkill);

let countS = 0;
const addSchool = ({schoolName, specialization, startDate, endDate, city, description}) => {
    let btn = document.getElementById("btn-school");
    let newDiv = document.createRange().createContextualFragment(
        `<div class="form-row">
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
                <input type="text" id="start-school-${countS}" class="start-date" name="school-start-date-${countS}" placeholder="Oct, 2019" required>
                <input type="text" id="end-school-${countS}" class="end-date" name="school-end-date-${countS}" placeholder="Nov, 2019" required>
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
    btn.parentNode.insertBefore(newDiv, btn);
    calendar(`school-${countS}`);
    ++countS;
    addHighlightEvents();
}

document.getElementById("btn-school").addEventListener("click", addSchool);

let countC = 0;
let firstCourse = true;
const addCourse = ({course}) => {
    let btn = document.getElementById("btn-course");
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
    btn.parentNode.insertBefore(newDiv, btn);
    ++countC;
    addHighlightEvents();
}

document.getElementById("btn-course").addEventListener("click", addCourse);

var inputs = document.querySelectorAll( '.inputfile' );
Array.prototype.forEach.call( inputs, function( input )
{
	var label	 = input.nextElementSibling,
		labelVal = label.innerHTML;

	input.addEventListener( 'change', function( e )
	{
		var fileName = '';
		if( this.files && this.files.length > 1 )
			fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
		else
			fileName = e.target.value.split( "\\" ).pop();

		if( fileName )
			label.innerHTML = fileName;
		else
			label.innerHTML = labelVal;
	});
});