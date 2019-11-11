var buttons=document.getElementsByClassName("btn");

for(let i=0; i<buttons.length-1; ++i){
    buttons[i].addEventListener("click", () => {
        hideDiv(document.getElementById(`sign-up-${i+1}`).id);
        showDiv(document.getElementById(`sign-up-${i+2}--hidden`).id)
    });
}