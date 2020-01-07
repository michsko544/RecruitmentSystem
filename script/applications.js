const addApplication = ({position,status}) => {
    let lastApp = document.querySelector(".list-row");
    let container = document.querySelector("#container");
    let newDiv;

    if(status==="sent"){
        newDiv = document.createRange().createContextualFragment(
        `<div class="list-row">
            <div class="position first-text">${position}</div>
            <div class="app-status-sent last-text">Application sent</div>
        </div>`);
    }
    else if(status==="opened"){
        newDiv = document.createRange().createContextualFragment(
            `<div class="list-row">
                <div class="position first-text">${position}</div>
                <div class="app-status-opened last-text">Application has been opened</div>
            </div>`);
    }
    else if(status==="chat"){
        newDiv = document.createRange().createContextualFragment(
            `<div class="list-row">
                <div class="position first-text">${position}</div>
                <div class="app-status-replied last-text">Recruiter contacted you. <a href="replies.php">Check your replies!</a></div>
            </div>`);
    }

    !lastApp ? container.appendChild(newDiv) : container.insertBefore(newDiv, lastApp);
}

document.querySelector("#btn-application").addEventListener("click", ()=>showDiv("app-form--hidden"));

document.querySelector(".close").addEventListener("click", ()=>hideDiv("app-form"));