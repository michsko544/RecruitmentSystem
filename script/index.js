var login = "";

var url_string = window.location.href;
var url = new URL(url_string);
var login = url.searchParams.get("login");
console.log(login);

document.getElementById("btn-exit").onclick = ()=>{
    hideDiv("sign-in");
    toggleBlur("index-container");
    url.searchParams.delete("login");
    window.history.replaceState(null, null, url);
    login = "";
}

document.getElementById("btn-sign-in").onclick = ()=>{
    showDiv("sign-in--hidden");
    toggleBlur("index-container");
};

if (login === "wrong"){
    showDiv("sign-in--hidden");
    toggleBlur("index-container");
}