const activeRoll = ()=>{
    var buttons = document.querySelectorAll(".btn-unwrap");
    var rows = document.querySelectorAll(".list-row");

    for(let i=0; i<buttons.length; ++i){
        var btn = buttons[i];
        btn.addEventListener("click", function(){
            rows[i*2+1].classList.toggle("hide");
            
            if(this.childNodes[1].style.animation==="0.5s ease 0s 1 normal forwards running line1Rotate"){
                this.childNodes[1].style.animation = `line2Rotate 0.5s ease forwards`;
                this.childNodes[3].style.animation = `line1Rotate 0.5s ease forwards`;
            } else if(this.childNodes[1].style.animation){
                this.childNodes[1].style.animation = `line1Rotate 0.5s ease forwards`;
                this.childNodes[3].style.animation = `line2Rotate 0.5s ease forwards`;
            } else {
                this.childNodes[1].style.animation = `line1Rotate 0.5s ease forwards`;
                this.childNodes[3].style.animation = `line2Rotate 0.5s ease forwards`;
            }
        })
    }
}

const addStage = ({stage,description,name}) => {
    let lastMsg = document.querySelector(".list-row");
    let container = document.querySelector("#container");
    let newDiv = document.createRange().createContextualFragment(
        `<div class="list-row">
            <div class="position first-text">${stage}</div>
            <div class="app-status-sent last-text">${name}</div>
            <div class="btn-element">
                <div class="btn-unwrap">
                    <div class="line1"></div>
                    <div class="line2"></div>
                </div>
            </div>
        </div>
        <div class="list-row hide">
            <div class="element-wrapper">
                ${description}
            </div>
        </div>`);
    !lastMsg ? container.appendChild(newDiv) : container.insertBefore(newDiv, lastMsg);
}

const addChangeDecisionBtn = () => {
    let container = document.querySelector("#container");
    var url_string = window.location.href;
    var url = new URL(url_string);
    var aid = url.searchParams.get("aid");
    let newDiv = document.createRange().createContextualFragment(
        `<div class="list-row bottom-row" id="change-decision-btn">
            <div class="btn-add ">
                <div class="btn-border">
                    <div class="btn-icon">
                        +
                    </div>
                </div>
                <div class="btn-text">
                    Change decision
                </div>
            </div>
        </div>
        <div id="add-bottom-btn-form2--hidden">
            <div class="close2">
                <div class="btn-close">
                    <div class="line1"></div>
                    <div class="line2"></div>
                </div>
            </div>
            <h3 class="description">Found interesting applicant?</h3>
            <form action="../php/AddDecision.php?aid=${aid}" id="change-decision" method="post"> <!-- TODO URL application id -->
                <div class="form-row">
                    <label for="user">Decision</label>
                    <select name="name-decision">
                        <option value="Noteworthy">Noteworthy</option>
                        <option value="Accepted">Accepted</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>
                <div class="btn-big-positioning">
                    <input type="submit" value="Change" class="btn btn-cyan">
                </div>
            </form>
        </div>`);
    container.appendChild(newDiv);
};