const activeRoll = ()=>{
    var buttons = document.querySelectorAll(".btn-unwrap");
    var rows = document.querySelectorAll(".list-row");

    for(let i=0; i<buttons.length; ++i){
        var btn = buttons[i];
        btn.addEventListener("click", function(){
            rows[i*2+1].classList.toggle("hide");
        })
        btn.onclick = function(){
            if(this.childNodes[1].style.animation==="0.5s ease 0s 1 normal forwards     running line1Rotate"){
                this.childNodes[1].style.animation = `line2Rotate 0.5s ease forwards`;
                this.childNodes[3].style.animation = `line1Rotate 0.5s ease forwards`;
            } else if(this.childNodes[1].style.animation){
                this.childNodes[1].style.animation = `line1Rotate 0.5s ease forwards`;
                this.childNodes[3].style.animation = `line2Rotate 0.5s ease forwards`;
            } else {
                this.childNodes[1].style.animation = `line1Rotate 0.5s ease forwards`;
                this.childNodes[3].style.animation = `line2Rotate 0.5s ease forwards`;
            }
        }
    }
}

const addStage = ({stage,description}) => {
    let lastMsg = document.querySelector(".list-row");
    let container = document.querySelector("#container");
    let newDiv = document.createRange().createContextualFragment(
        `<div class="list-row">
            <div class="position first-text">${stage}</div>
            <div class="app-status-sent last-text">John Smith</div>
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