var buttons=document.getElementsByClassName("btn");

const colorCyan = "#36C3D9";

/*const convertDateDisplay = function(id) {
    let date = document.getElementById(id).value;
    console.log(date);
    let year = `${date[6]}${date[7]}${date[8]}${date[9]}`;
    let month = `${date[0]}${date[1]}`;
    switch (month) {
        case "01": 
            month = "Jan";
            break;
        case "02": 
            month = "Feb";
            break;
        case "03": 
            month = "Mar";
            break;
        case "04": 
            month = "Apr";
            break;
        case "05": 
            month = "May";
            break;
        case "06": 
            month = "Jun";  
            break;
        case "07": 
            month = "Jul";
            break;
        case "08": 
            month = "Aug";
            break;
        case "09": 
            month = "Sep";
            break;
        case "10": 
            month = "Oct";
            break;
        case "11": 
            month = "Nov";
            break;
        case "12": 
            month = "Dec";
            break;
        default:
            month = "Jan";
    }
    return `${month},${year}`;
}

const updateDisplayOnchange = (id) => {
    document.getElementById(id).onchange = function(){
        console.log(this);
        this.setAttribute("value", convertDateDisplay(id));
    };
    return true;
}*/

const highlightLabel = function() { //id inputa
    console.log(this);
    this.addEventListener("focus", function(){
        console.log(this.parentNode.parentNode.children[0]);
        this.parentNode.className==="form-row" 
        ?
            this.parentNode.children[0].classList.toggle("cyan-color") //dla daty dwa parentNode
            :
            this.parentNode.parentNode.children[0].classList.toggle("cyan-color");
    });
    this.addEventListener("focusout", function(){
        console.log(this.parentNode.parentNode.children[0]);
        this.parentNode.className==="form-row" 
        ?
            this.parentNode.children[0].classList.toggle("cyan-color") //dla daty dwa parentNode
            :
            this.parentNode.parentNode.children[0].classList.toggle("cyan-color");
    });
}

const addHighlightEvents = () => {
    const inputs = document.querySelectorAll("input");
    console.dir(inputs);
    inputs.forEach( elem => {
        console.dir(elem);
        highlightLabel.bind(elem);

        highlightLabel();
        return true;
    });
    return true;
}

addHighlightEvents();
console.log("loadEvents");

calendar("exp-0");
//updateDisplayOnchange("start-exp-0");
//updateDisplayOnchange("end-exp-0");
calendar("school-0");
//updateDisplayOnchange("start-school-0");
//updateDisplayOnchange("end-school-0");

document.getElementById("no-experience").addEventListener("click", function(){
    if(this.checked===true){
        document.getElementById('sform-3').querySelectorAll('div.form-row').forEach(element=>{element.children[1]!==undefined ? element.children[1].required=false : console.log(false)}); 

        hideDiv("btn-experiance");
    } else {
        document.getElementById('sform-3').querySelectorAll('div.form-row').forEach(element=>{element.children[1]!==undefined ? element.children[1].required=true : console.log(false)});

        showDiv("btn-experiance--hidden");
    }
});


let countE = 1;
const addExperience = () => {
    let btn = document.getElementById("btn-experiance");
    let newDiv = document.createRange().createContextualFragment(
        `<div class="form-row">
            </br>
            </br>
            <label for="job-title">Job title</label>
            <input type="text" name="job-title-${countE}" placeholder="Waiter" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="employer">Employer</label>
            <input type="text" name="employer-${countE}" placeholder="Italian Restaurant London" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="start-end-date">Start & End date</label>
            <div class="date">
                <input type="text" id="start-exp-${countE}" class="start-date"  name="start-date-${countE}" placeholder="Oct, 2019" required>
                <input type="text" id="end-exp-${countE}" class="end-date" name="end-date-$ {countE}" placeholder="Nov, 2019" required>
            </div>
        </div>
        <div class="form-row">
            <label for="job-city">City</label>
            <input type="text" name="job-city-${countE}" placeholder="London" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="job-description">Description</label>
            <textarea name="job-description-${countE}" cols="35" rows="4" placeholder="e.g. waitressing,preparing venue for events, taking care of restaurant clarity, making basic drinks, brewing coffee" required></textarea>
            <div class="underlineTA"></div>
        </div>`
    );

    btn.parentNode.insertBefore(newDiv, btn);
    calendar(`exp-${countE}`);
    //updateDisplayOnchange(`start-exp-${countE}`);
    //updateDisplayOnchange(`end-exp-${countE}`);
    ++countE;
}

document.getElementById("btn-experiance").addEventListener("click", addExperience);

let countL = 1;
const addLanguage = () => {
    let btn = document.getElementById("btn-language");
    let newDiv = document.createRange().createContextualFragment(
    `<div class="form-row">
        <input type="text" name="languages-${countL}" placeholder="German" required>
        <div class="underline"></div>
        <div class="degree">
            <input type="number" name="language_level" min=1 max=5 placeholder=1>
            <div class="limit">/5</div>
        </div>
    </div>`);
    btn.parentNode.insertBefore(newDiv, btn);
    ++countL;
}

document.getElementById("btn-language").addEventListener("click", addLanguage);

let countSk = 1;
const addSkill = () => {
    let btn = document.getElementById("btn-skill");
    let newDiv = document.createRange().createContextualFragment(
    `<div class="form-row">
        <input type="text" name="skills-${countSk}" placeholder="Marketing" required>
        <div class="underline"></div>
        <div class="degree">
            <input type="number" name="skill-level-${countSk}" min=1 max=5 placeholder=1>
            <div class="limit">/5</div>
        </div>
    </div>`);
    btn.parentNode.insertBefore(newDiv, btn);
    ++countSk;
}

document.getElementById("btn-skill").addEventListener("click", addSkill);

let countS = 1;
const addSchool = () => {
    let btn = document.getElementById("btn-school");
    let newDiv = document.createRange().createContextualFragment(
        `</br>
        </br>
        <div class="form-row">
            <label for="school">School</label>
            <input type="text" name="school-${countS}" placeholder="Silesian University of  Technology" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="specialization">Specialization</label>
            <input type="text" name="specialization-${countS}" placeholder="Teleinformatics"    required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="start-end-date">Start & End date</label>
            <div class="date">
                <input type="text" id="start-school-${countS}" class="start-date"       name="school-start-date-${countS}" placeholder="Oct, 2019" required>
                <input type="text" id="end-school-${countS}" class="end-date"       name="school-end-date-${countS}" placeholder="Nov, 2019" required>
            </div>
        </div>
        <div class="form-row">
            <label for="school-city">City</label>
            <input type="text" name="school-city-${countS}" placeholder="Gliwice" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="school-description">Description</label>
            <textarea name="school-description-${countS}" cols="35" rows="4" placeholder="e.g.  programming, data analysing, network designing, microprocessors coding"></textarea>
            <div class="underlineTA"></div>
        </div>`
    );
    btn.parentNode.insertBefore(newDiv, btn);
    calendar(`school-${countS}`);
    updateDisplayOnchange(`start-school-${countS}`);
    updateDisplayOnchange(`end-school-${countS}`);
    ++countS;
}

document.getElementById("btn-school").addEventListener("click", addSchool);

let CountC = 1;
const addCourse = () => {
    let btn = document.getElementById("btn-course");
    let newDiv = document.createRange().createContextualFragment(
        `<div class="form-row">
            <input type="text" name="course-${countC}" placeholder="e.g. Google Internet    Revolutions">
            <div class="underline"></div>
        </div>`
    );
    btn.parentNode.insertBefore(newDiv, btn);
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