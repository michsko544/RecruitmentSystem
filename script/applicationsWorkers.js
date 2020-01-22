const addApplication = ({position, name, decision, id}) => {
    let lastApp = document.querySelector(".list-row");
    let container = document.querySelector("#container");
    let newDiv;

    if(decision==="rejected"){
        newDiv = document.createRange().createContextualFragment(
        `<div class="list-row">
            <div class="position first-text">${position}</div>
            <div class="app-info last-text">${name} - Rejected</div>
            <a href="profileW.php?uid=${id}" class="btn-element rotate-to-right" >
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
                <a href="profileW.php?uid=${id}" class="btn-element rotate-to-right" >
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
                <a href="profileW.php?uid=${id}" class="btn-element rotate-to-right" >
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
                <a href="profileW.php?uid=${id}" class="btn-element rotate-to-right" >
                    <div class="btn-unwrap">
                        <div class="line1"></div>
                        <div class="line2"></div>
                    </div>
                </a>
            </div>`);
    }

    !lastApp ? container.appendChild(newDiv) : container.insertBefore(newDiv, lastApp);
}

//document.querySelector("#btn-application").addEventListener("click", ()=>showDiv("app-form--hidden"));

//document.querySelector(".close").addEventListener("click", ()=>hideDiv("app-form"));