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
};

const addApplicationWithChangeDecision = ({position, name, decision, id, aid})=> {
    let lastApp = document.querySelector(".list-row");
    let container = document.querySelector("#container");
    let newDiv;

    if(decision==="rejected"){
        newDiv = document.createRange().createContextualFragment(
        `<div class="list-row">
            <div class="change-btn"></div>
            <div class="position first-text-after-btn">${position}</div>
            <div class="app-info last-text-after-btn">${name} - Rejected</div>
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
                <div class="change-btn"></div>
                <div class="position first-text-after-btn">${position}</div>
                <div class="app-info last-text-after-btn">${name} - Accepted</div>
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
                <div class="change-btn"></div>
                <div class="position first-text-after-btn">${position}</div>
                <div class="app-info last-text-after-btn">${name} - <span class="cyan-color">Noteworthy</span></div>
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
                <div class="change-btn"></div>
                <div class="position first-text-after-btn">${position}</div>
                <div class="app-info last-text-after-btn">${name} - New</div>
                <a href="profileW.php?uid=${id}&aid=${aid}" class="btn-element rotate-to-right" >
                    <div class="btn-unwrap">
                        <div class="line1"></div>
                        <div class="line2"></div>
                    </div>
                </a>
            </div>`);
    }

    !lastApp ? container.appendChild(newDiv) : container.insertBefore(newDiv, lastApp);
};

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
            <form action="../php/AddPosition.php" method="post">
                <div class="form-row">
                    <label for="user">Position title</label>
                    <input type="text" name="position" required>
                    <div class="underline"></div>
                </div>
                <div class="form-row">
                    <label for="description">Description</label>
                    <textarea name="description" cols="35" rows="4" placeholder="e.g.  programming, data analysing, network designing, microprocessors coding"></textarea>
                    <div class="underlineTA"></div>
                </div>
                <div class="btn-big-positioning">
                    <input type="submit" value="Add" class="btn btn-cyan">
                </div>
            </form>
        </div>`);
    container.appendChild(newDiv);
    console.log("added",container,newDiv)
};

const addChangeDecisionForm = () => {
    let container = document.querySelector("#container");
    let newDiv = document.createRange().createContextualFragment(
        `<div id="add-bottom-btn-form2--hidden">
            <div class="close2">
                <div class="btn-close">
                    <div class="line1"></div>
                    <div class="line2"></div>
                </div>
            </div>
            <h3 class="description">Found interesting applicant?</h3>
            <form action="../php/AddDecision.php" method="post"> <!-- TODO URL application id -->
                <div class="form-row">
                    <label for="user">Decision</label>
                    <select name="name-decision">
                        <option value="Noteworthy">Noteworthy</option>
                        <option value="Accepted">Accepted</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>
                <div class="btn-big-positioning">
                    <input type="submit" value="Change" class="btn btn-cyan">
                </div>
            </form>
        </div>`);
    container.appendChild(newDiv);
    console.log("added",container,newDiv)
};