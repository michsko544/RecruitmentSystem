document.getElementById("btn-exit").onclick = ()=>{
    hideDiv("sign-in");
    toggleBlur("index-container");
    login = "";
};

document.getElementById("btn-sign-in").onclick = ()=>{
    showDiv("sign-in--hidden");
    toggleBlur("index-container");
};

if (login === "wrong"){
    showDiv("sign-in--hidden");
    toggleBlur("index-container");
}