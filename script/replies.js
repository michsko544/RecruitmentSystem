const addReply = ({id,name,role,position,topic,date}) => {
    console.log(id);
    let lastMsg = document.querySelector(".list-row").parentNode;
    let container = document.querySelector("#container");
    let newDiv = document.createRange().createContextualFragment(
    `<a href="${'chat.php?cid=' + id || '#'}">
        <div class="list-row">
            <div class="first-text">${position ? "Reply: " + position : topic }</div>
            <div class="msg-topic last-text">${name}${role ? " - " + role : ""}</div>
            <div class="msg-date right-info">${date}</div>
        </div>
    </a>`);
    !lastMsg ? container.appendChild(newDiv) : container.insertBefore(newDiv, lastMsg);
}

const addChangeConversatorBtn = () => {
    let container = document.querySelector("#container");
    let newDiv = document.createRange().createContextualFragment(
        `<div class="list-row bottom-row" id="btn-application">
            <div class="btn-add ">
                <div class="btn-border">
                    <div class="btn-icon">
                        +
                    </div>
                </div>
                <div class="btn-text">
                    New message
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
            <h3 class="description">Choose who you want to message</h3>
            <form action="" method="post">
                <div class="form-row">
                    <label for="user">Colleague</label>
                    <select></select>
                </div>
                <div class="btn-big-positioning">
                    <input type="submit" value="Write" class="btn btn-cyan">
                </div>
            </form>
        </div>`);
    container.appendChild(newDiv);
    console.log("added",container,newDiv)
};