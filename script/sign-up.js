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
    inputs.forEach( elem => {
        console.dir(elem);
        highlightLabel(elem);
        return true;
    });
    textareas.forEach( elem => {
        highlightLabel(elem);
        return true;
    });
    return true;
}

addHighlightEvents();


calendar("exp-0");

calendar("school-0");


document.getElementById("no-experience").addEventListener("click", function(){
    if(this.checked===true){
        document.getElementById('sform-3').querySelectorAll('div.form-row').forEach(element=>{element.children[1]!==undefined ? element.children[1].required=false : console.log(false)}); 

        hideDiv("btn-experiance");
    } else {
        document.getElementById('sform-3').querySelectorAll('div.form-row').forEach(element=>{element.children[1]!==undefined ? element.children[1].required=true : console.log(false)});

        showDiv("btn-experiance--hidden");
    }
});

const readJSON = (filePath) => {
    let file;
    $.getJSON(filePath, function(json) {
        file = json; // this will show the info it in firebug console
        console.log(file);
    });
    console.log(file);
    return file;
}

var profileJSON = readJSON("json/profile.json");
console.log(profileJSON);

const fromJsonToHtml = (json) => {
    const pD = json.personal-data;
    const exp = json.experience;
    const sql = json.education;
    const skl = json.skills.skills;
    const lang = json.skills.languages;
    const add = json.additional;
    const n = json.counters;

    let pDProps = {
        firstName: pD.first-name,
        lastName: pD.last-name,
        phone: pD.phone,
        country: pD.country,
        city: pD.city
    };
    addPersonalData(pDProps);

    for(let i = 0; i<n.experience; ++i){
        let props = {
            jobTitle: exp.job-title[i],
            employer: exp.employer[i],
            startDate: exp.start-date[i],
            endDate: exp.end-date[i],
            city: exp.city[i],
            description: exp.description[i]
        };
        addExperience(props);
    }

    for(let i = 0; i<n.education; ++i){
        let props = {
            schoolName: sql.school-name[i],
            specialization: sql.specialization[i],
            startDate: sql.start-date[i],
            endDate: sql.end-date[i],
            city: sql.city[i],
            description: sql.description[i]
        };
        addSchool(props);
    }
        
    for(let i = 0; i<n.skill; ++i){
        let props = {
            skill: skl.skill[i],
            level: skl.level[i]
        };
        addSkill(props);
    }
        
    for(let i = 0; i<n.language; ++i){
        let props = {
            lang: lang.lang[i],
            level: lang.level[i]
        };
        addLanguage(props);
    }
        
    /*for(let i = 0; i<n.cover-letter; ++i)
        addCL();
    for(let i = 0; i<n.certificate; ++i)
        addCertificate();
    for(let i = 0; i<n.course; ++i)
        addCourse()
    addCV();*/
}

//fromJsonToHtml(json);

let countE = 1;
const addExperience = ({jobTitle, employer, startDate, endDate, city, description}) => {
    let btn = document.getElementById("btn-experiance");
    let newDiv = document.createRange().createContextualFragment(
        `<div class="form-row">
            </br>
            </br>
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

let countL = 1;
const addLanguage = ({lang, level}) => {
    let btn = document.getElementById("btn-language");
    let newDiv = document.createRange().createContextualFragment(
    `<div class="form-row">
        <input type="text" name="languages-${countL}" placeholder="German" value="${lang || ""}" required>
        <div class="underline"></div>
        <div class="degree">
            <input type="number" name="language_level-${countL}" min=1 max=5 placeholder=1 value="${level || 1}">
            <div class="limit">/5</div>
        </div>
    </div>`);
    btn.parentNode.insertBefore(newDiv, btn);
    ++countL;
    addHighlightEvents();
}

document.getElementById("btn-language").addEventListener("click", addLanguage);

let countSk = 1;
const addSkill = ({skill, level}) => {
    let btn = document.getElementById("btn-skill");
    let newDiv = document.createRange().createContextualFragment(
    `<div class="form-row">
        <input type="text" name="skills-${countSk}" placeholder="Marketing" value="${skill || ""}"required>
        <div class="underline"></div>
        <div class="degree">
            <input type="number" name="skill-level-${countSk}" min=1 max=5 placeholder=1 value="${level || 1}">
            <div class="limit">/5</div>
        </div>
    </div>`);
    btn.parentNode.insertBefore(newDiv, btn);
    ++countSk;
    addHighlightEvents();
}

document.getElementById("btn-skill").addEventListener("click", addSkill);

let countS = 1;
const addSchool = ({schoolName, specialization, startDate, endDate, city, description}) => {
    let btn = document.getElementById("btn-school");
    let newDiv = document.createRange().createContextualFragment(
        `</br>
        </br>
        <div class="form-row">
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

let countC = 1;
const addCourse = ({course}) => {
    let btn = document.getElementById("btn-course");
    let newDiv = document.createRange().createContextualFragment(
        `<div class="form-row">
            <input type="text" name="course-${countC}" placeholder="e.g. Google Internet Revolutions" value="${course || ""}">
            <div class="underline"></div>
        </div>`
    );
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