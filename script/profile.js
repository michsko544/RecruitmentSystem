var buttons = document.querySelectorAll(".btn-unwrap");
var rows = document.querySelectorAll(".list-row");


for(let i=0; i<buttons.length; ++i){
    var btn = buttons[i];
    btn.addEventListener("click", function(){
        console.log(i);
        rows[i*2+1].classList.toggle("hide");
    })
    btn.onclick = function(){
        console.log(this.childNodes);
        if(this.childNodes[1].style.animation==="0.5s ease 0s 1 normal forwards running line1Rotate"){
            this.childNodes[1].style.animation = `line2Rotate 0.5s ease forwards`;
            this.childNodes[3].style.animation = `line1Rotate 0.5s ease forwards`;
            console.log(this.childNodes[1].style.animation==="0.5s ease 0s 1 normal forwards running line2Rotate");
        } else if(this.childNodes[1].style.animation){
            this.childNodes[1].style.animation = `line1Rotate 0.5s ease forwards`;
            this.childNodes[3].style.animation = `line2Rotate 0.5s ease forwards`;
        } else {
            this.childNodes[1].style.animation = `line1Rotate 0.5s ease forwards`;
            this.childNodes[3].style.animation = `line2Rotate 0.5s ease forwards`;
            console.log(this.childNodes[1].style.animation);
        }
    }
}