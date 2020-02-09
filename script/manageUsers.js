const addUser = ({name, login, id})=> {
    let lastApp = document.querySelector(".list-row");
    let container = document.querySelector("#container");
    let newDiv;
    
    newDiv = document.createRange().createContextualFragment(
        `<div class="list-row">
            <a href="#">
                <div class="block">
                </div>
            </a>    
            <div class="position first-text-after-btn">${name}</div>
            <div class="app-info last-text-after-btn">${login}</div>
            <a href="#">
                <div class="delete">
                </div>
            </a>
        </div>`);
    

    !lastApp ? container.appendChild(newDiv) : container.insertBefore(newDiv, lastApp);
};