const initEmptySignUpInputs = () => {
    addExperience({});
    addLanguage({});
    addSkill({});
    addSchool({});
    addCourse({});
}

initEmptySignUpInputs();

/*const passCountersToUrl = () => {
    let btns = document.querySelectorAll(".btn-add");
    var url_string = window.location.href;
    var url = new URL(url_string);

    btns.forEach(btn=>{
        if(btn.id==="btn-experience"){
            btn.addEventListener("click", ()=>{
                url.searchParams.set("countE", countE);
                window.history.replaceState(null, null, url);
            });
        }
        else if(btn.id==="btn-language"){
            btn.addEventListener("click", ()=>{
                url.searchParams.set("countL", countL);
                window.history.replaceState(null, null, url);
            });
        }
        else if(btn.id==="btn-skill"){
            btn.addEventListener("click", ()=>{
                url.searchParams.set("countSk", countSk);
                window.history.replaceState(null, null, url);
            });
        }
        else if(btn.id==="btn-school"){
            btn.addEventListener("click", ()=>{
                url.searchParams.set("countS", countS);
                window.history.replaceState(null, null, url);
            });
        }
        else if(btn.id==="btn-course"){
            btn.addEventListener("click", ()=>{
                url.searchParams.set("countC", countC);
                window.history.replaceState(null, null, url);
            });
        }
    })
}

passCountersToUrl();*/