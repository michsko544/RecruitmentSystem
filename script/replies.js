const addReply = ({id,name,role,position,topic,date}) => {
    console.log(id);
    let lastMsg = document.querySelector(".list-row").parentNode;
    let container = document.querySelector("#container");
    let newDiv = document.createRange().createContextualFragment(
    `<a href="${'chat.php?cid=' + id || '#'}">
        <div class="list-row">
            <div class="first-text">${topic ? topic : "Reply: " + position}</div>
            <div class="msg-topic last-text">${name + " - " || ""}${role}</div>
            <div class="msg-date right-info">${date}</div>
        </div>
    </a>`);
    !lastMsg ? container.appendChild(newDiv) : container.insertBefore(newDiv, lastMsg);
}