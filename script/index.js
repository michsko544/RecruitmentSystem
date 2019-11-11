const hideDiv = (id) => {
    document.getElementById(id).id=id+"--hidden";
};

const showDiv = (id) => {
    document.getElementById(id).id=id.slice(0,-8);
};

const toggleBlur = (id) => {
    document.getElementById(id).classList.toggle("blur");
}


document.getElementById("btn-exit").onclick = ()=>{
    hideDiv("sign-in");
    toggleBlur("index-container");
};

document.getElementById("btn-sign-in").onclick = ()=>{
    showDiv("sign-in--hidden");
    toggleBlur("index-container");
};