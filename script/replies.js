const addReply = ({id,position,topic,date}) => {
    console.log(id);
    let lastMsg = document.querySelector(".list-row").parentNode;
    let newDiv = document.createRange().createContextualFragment(
    `<a href="${'conversation.php?conv=' + id || '#'}">
        <div class="list-row">
            <div class="first-text">${position}</div>
            <div class="msg-topic last-text">${topic}</div>
            <div class="msg-date right-info">${date}</div>
        </div>
    </a>`);
    lastMsg.parentNode.insertBefore(newDiv, lastMsg);
}