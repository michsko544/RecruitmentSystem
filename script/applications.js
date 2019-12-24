const addApplication = ({position,status}) => {
    let lastApp = document.querySelector(".list-row");
    let newDiv;

    if(status===0){
        newDiv = document.createRange().createContextualFragment(
        `<div class="list-row">
            <div class="position first-text">${position}</div>
            <div class="app-status-sent last-text">Application sent</div>
        </div>`);
    }
    else if(status===1){
        newDiv = document.createRange().createContextualFragment(
            `<div class="list-row">
                <div class="position first-text">${position}</div>
                <div class="app-status-opened last-text">Application has been opened</div>
            </div>`);
    }
    else if(status===2){
        newDiv = document.createRange().createContextualFragment(
            `<div class="list-row">
                <div class="position first-text">${position}</div>
                <div class="app-status-replied last-text">Recruiter contacted you. <a href="replies.php">Check your replies!</a></div>
            </div>`);
    }

    lastApp.parentNode.insertBefore(newDiv, lastApp);
}