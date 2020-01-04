const findConversator = (json) => {
    const id = json.idLoggedUser===json.idUser[0] ? json.idUser2[0] : json.idUser[0];
    const index = json.senderId.findIndex(elem=>elem === id);
    const name = json.senderName[index];
    const surname = json.senderSurname[index];
    const role = json.senderRole[index];
    return {
        id,
        name,
        surname,
        role
    };
}

const addConvesationTitle = ({sender: {id, name, surname, role}, topic, position}) => {
    let container = document.querySelector("#container");
    let newDiv = document.createRange().createContextualFragment(
    `<div class="big-title">
        <div class="title">Chat</div>
        <a href="replies.php"><div class="back"></div></a>
        <a href="write-msg.php?uid="${id}"><div class="write"></div></a>
        <div class="with">With: ${name} ${surname}${role ? " - " + role : ""}</div>
        <div class="topic">Topic: ${topic ? topic : "Reply: " + position}</div>
    </div>`);
    container.appendChild(newDiv);
}

const addMessage = ({message, date, user}) => {
    let container = document.querySelector("#container");
    let newDiv = document.createRange().createContextualFragment(
    `<div class="message">
        <div class="date">${date}</div>
        <div class="content ${user ? "right" : "left"}">${message}</div>
    </div>`);
    container.appendChild(newDiv);
}