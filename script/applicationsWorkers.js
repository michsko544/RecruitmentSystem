const addApplication = ({position, name, decision, id, aid}) => {
    let lastApp = document.querySelector(".list-row");
    let container = document.querySelector("#container");
    let newDiv;

    if(decision==="rejected"){
        newDiv = document.createRange().createContextualFragment(
        `<div class="list-row">
            <div class="position first-text">${position}</div>
            <div class="app-info last-text">${name} - Rejected</div>
            <a href="profileW.php?uid=${id}&aid=${aid}" class="btn-element rotate-to-right" >
                    <div class="btn-unwrap">
                        <div class="line1"></div>
                        <div class="line2"></div>
                    </div>
                </a>
        </div>`);
    }
    else if(decision==="accepted"){
        newDiv = document.createRange().createContextualFragment(
            `<div class="list-row">
                <div class="position first-text">${position}</div>
                <div class="app-info last-text">${name} - Accepted</div>
                <a href="profileW.php?uid=${id}&aid=${aid}" class="btn-element rotate-to-right" >
                    <div class="btn-unwrap">
                        <div class="line1"></div>
                        <div class="line2"></div>
                    </div>
                </a>
            </div>`);
    }
    else if(decision==="noteworthy"){
        newDiv = document.createRange().createContextualFragment(
            `<div class="list-row">
                <div class="position first-text">${position}</div>
                <div class="app-info last-text">${name} - <span class="cyan-color">Noteworthy</span></div>
                <a href="profileW.php?uid=${id}&aid=${aid}" class="btn-element rotate-to-right" >
                    <div class="btn-unwrap">
                        <div class="line1"></div>
                        <div class="line2"></div>
                    </div>
                </a>
            </div>`);
    } else {
        newDiv = document.createRange().createContextualFragment(
            `<div class="list-row">
                <div class="position first-text">${position}</div>
                <div class="app-info last-text">${name} - New</div>
                <a href="profileW.php?uid=${id}&aid=${aid}" class="btn-element rotate-to-right" >
                    <div class="btn-unwrap">
                        <div class="line1"></div>
                        <div class="line2"></div>
                    </div>
                </a>
            </div>`);
    }

    !lastApp ? container.appendChild(newDiv) : container.insertBefore(newDiv, lastApp);
}

const addPositionBtn = () => {
    let container = document.querySelector("#container");
    let newDiv = document.createRange().createContextualFragment(
        `<div class="list-row bottom-row" id="btn-position">
            <div class="btn-add ">
                <div class="btn-border">
                    <div class="btn-icon">
                        +
                    </div>
                </div>
                <div class="btn-text">
                    Add position
                </div>
            </div>
        </div>
        <div id="add-bottom-btn-form--hidden">
            <div class="close">
                <div class="btn-close">
                    <div class="line1"></div>
                    <div class="line2"></div>
                </div>
            </div>
            <h3 class="description">Name position you want to add.</h3>
            <form action="" method="post">
                <div class="form-row">
                    <label for="user">Position title</label>
                    <input type="text">
                </div>
                <div class="btn-big-positioning">
                    <input type="submit" value="Add" class="btn btn-cyan">
                </div>
            </form>
        </div>`);
    container.appendChild(newDiv);
    console.log("added",container,newDiv)
};