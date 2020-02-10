const addUser = ({name, login, id})=> {
    let lastApp = document.querySelector(".list-row");
    let container = document.querySelector("#container");
    let newDiv;
    
    newDiv = document.createRange().createContextualFragment(
        `<div class="list-row">
            <a href="./php/admin/block_user.php?uid=${id}">
                <div class="block-btn">
                </div>
            </a>    
            <div class="position first-text-after-btn">${name}</div>
            <div class="app-info last-text-after-btn">Username: ${login}</div>
            <a href="./php/admin/delete_user.php?uid=${id}">
                <div class="delete-btn">
                </div>
            </a>
        </div>`);
    console.log(lastApp);
    container.appendChild(newDiv)
};