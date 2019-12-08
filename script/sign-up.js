var buttons=document.getElementsByClassName("btn");

for(let i=0; i<buttons.length-1; ++i){
    // $(`sform-${i+1}`).submit(function(e) {
    //     // tasks to do 
    //     e.preventDefault();
    //     if(!$(this).valid()){
            
    //         console.log("Poprawnie wypelniony");
    //         hideDiv(document.getElementById(`sign-up-${i+1}`).id);
    //         console.log(`chowam ${i+1}`);
    //         showDiv(document.getElementById(`sign-up-${i+2}--hidden`).id);
    //         console.log(`pokazuje ${i+2}`);
    //     }
    // });
    // $(`#sform-${i+1}`).submit(function(e){
    //     e.preventDefault();
    //     $.ajax({
    //         url:'',
    //         type:'post',
    //         data:$(`#sform-${i+1}`).serialize(),
    //         success:function(){
    //             console.log("Poprawnie wypelniony");
    //             hideDiv(document.getElementById(`sign-up-${i+1}`).id);
    //             console.log(`chowam ${i+1}`);
    //             showDiv(document.getElementById(`sign-up-${i+2}--hidden`).id);
    //             console.log(`pokazuje ${i+2}`);
    //         }
    //     });
    // });
}

document.getElementById("no-experience").addEventListener("click", function(){
    if(this.checked===true){
        document.getElementById('sform-3').querySelectorAll('div.form-row').forEach(element=>{element.children[1]!==undefined ? element.children[1].required=false : console.log(false)}); 

        hideDiv("btn-experiance");
    } else {
        document.getElementById('sform-3').querySelectorAll('div.form-row').forEach(element=>{element.children[1]!==undefined ? element.children[1].required=true : console.log(false)});

        showDiv("btn-experiance--hidden");
    }
});



const addExperience = () => {
    let btn = document.getElementById("btn-experiance");
    let newDiv = document.createRange().createContextualFragment(
    `<div class="form-row">
        </br>
        </br>
        <label for="job-title">Job title</label>
        <input type="text" name="job-title" placeholder="Waiter" required>
        <div class="underline"></div>
        </div>
        <div class="form-row">
        <label for="employer">Employer</label>
        <input type="text" name="employer" placeholder="Italian Restaurant London" required>
        <div class="underline"></div>
        </div>
        <div class="form-row">
        <label for="start-end-date">Start & End date</label>
        <div class="date">
            <input type="text" id="datej" class="start-date" name="start-date" placeholder="Oct, 2019" required>
            <input type="text" id="datej" class="end-date" name="end-date" placeholder="Nov, 2019" required>
        </div>
        </div>
        <div class="form-row">
        <label for="job-city">City</label>
        <input type="text" name="job-city" placeholder="London" required>
        <div class="underline"></div>
        </div>
        <div class="form-row">
        <label for="job-description">Description</label>
        <textarea name="job-description" cols="35" rows="4" placeholder="e.g. waitressing,preparing venue for events, taking care of restaurant clarity, making basic drinks, brewing coffee" required></textarea>
        <div class="underlineTA"></div>
    </div>`);

    btn.parentNode.insertBefore(newDiv, btn);
}

document.getElementById("btn-experiance").addEventListener("click", addExperience);

const addLanguage = () => {
    let btn = document.getElementById("btn-language");
    let newDiv = document.createRange().createContextualFragment(
    `<div class="form-row">
        <input type="text" name="languages" placeholder="German" required>
        <div class="underline"></div>
        <div class="degree">
            <input type="number" name="language_level" min=1 max=5 placeholder=1>
            <div class="limit">/5</div>
        </div>
    </div>`);
    btn.parentNode.insertBefore(newDiv, btn);
}

document.getElementById("btn-language").addEventListener("click", addLanguage);

const addSkill = () => {
    let btn = document.getElementById("btn-skill");
    let newDiv = document.createRange().createContextualFragment(
    `<div class="form-row">
        <input type="text" name="skills" placeholder="Marketing" required>
        <div class="underline"></div>
        <div class="degree">
            <input type="number" name="skill_level" min=1 max=5 placeholder=1>
            <div class="limit">/5</div>
        </div>
    </div>`);
    btn.parentNode.insertBefore(newDiv, btn);
}

document.getElementById("btn-skill").addEventListener("click", addSkill);

const addSchool = () => {
    let btn = document.getElementById("btn-school");
    let newDiv = document.createRange().createContextualFragment(
    `</br>
    </br>
    <div class="form-row">
    <label for="school">School</label>
    <input type="text" name="school" placeholder="Silesian University of Technology" required>
    <div class="underline"></div>
    </div>
    <div class="form-row">
    <label for="specialization">Specialization</label>
    <input type="text" name="specialization" placeholder="Teleinformatics" required>
    <div class="underline"></div>
    </div>
    <div class="form-row">
    <label for="start-end-date">Start & End date</label>
    <div class="date">
        <input type="text" class="start-date" name="start-date" placeholder="Oct, 2019" required>
        <input type="text" class="end-date" name="end-date" placeholder="Nov, 2019" required>
    </div>
    </div>
    <div class="form-row">
    <label for="school-city">City</label>
    <input type="text" name="school-city" placeholder="Gliwice" required>
    <div class="underline"></div>
    </div>
    <div class="form-row">
    <label for="school-description">Description</label>
    <textarea name="school-description" cols="35" rows="4" placeholder="e.g. programming, data analysing, network designing, microprocessors coding"></textarea>
    <div class="underlineTA"></div>
    </div>`);
    btn.parentNode.insertBefore(newDiv, btn);
}

document.getElementById("btn-school").addEventListener("click", addSchool);


const addCourse = () => {
    let btn = document.getElementById("btn-course");
    let newDiv = document.createRange().createContextualFragment(
    `<div class="form-row">
        <input type="text" name="course" placeholder="e.g. Google Internet Revolutions">
        <div class="underline"></div>
    </div>`);
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