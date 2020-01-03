const addReply = ({id,name,role,position,topic,date}) => {
    console.log(id);
    let lastMsg = document.querySelector(".list-row").parentNode;
    let container = document.querySelector("#container");
    let newDiv = document.createRange().createContextualFragment(
    `<a href="${'conversation.php?cid=' + id || '#'}">
        <div class="list-row">
            <div class="first-text">${"Reply: " + position || topic}</div>
            <div class="msg-topic last-text">${name + " - " || ""}${role}</div>
            <div class="msg-date right-info">${date}</div>
        </div>
    </a>`);
    !lastMsg ? container.appendChild(newDiv) : container.insertBefore(newDiv, lastMsg);
}