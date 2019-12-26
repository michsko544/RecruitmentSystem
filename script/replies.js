const addReply = ({id,position,topic,date}) => {
    console.log(id);
    let lastMsg = document.querySelector(".list-row").parentNode;
    let container = document.querySelector("#container");
    let newDiv = document.createRange().createContextualFragment(
    `<a href="${'conversation.php?cid=' + id || '#'}">
        <div class="list-row">
            <div class="first-text">${position}</div>
            <div class="msg-topic last-text">${topic}</div>
            <div class="msg-date right-info">${date}</div>
        </div>
    </a>`);
    !lastMsg ? container.appendChild(newDiv) : container.insertBefore(newDiv, lastMsg);
}