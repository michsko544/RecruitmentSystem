var burger = document.getElementById("btn-burger");
var nav = document.querySelector(".nav-links");
const navLinks = document.querySelectorAll(".nav-links li");
var navHelp = document.getElementById("nav-help");

burger.onclick = () => {
    navHelp.classList.toggle("helper");
    toggleBlur("container");
    document.querySelector(".nav-bar").classList.toggle("fixed")
    nav.classList.toggle("nav-active");

    navLinks.forEach((link, index)=>{
        if(link.style.animation)
            link.style.animation="";
        else
            link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.1}s`;
    });

    burger.classList.toggle("toggle");
};