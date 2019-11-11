document.getElementById("btn-exit").onclick = ()=>{
    hideDiv("sign-in");
    toggleBlur("index-container");
};

document.getElementById("btn-sign-in").onclick = ()=>{
    showDiv("sign-in--hidden");
    toggleBlur("index-container");
};