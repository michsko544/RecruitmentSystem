const addMsgTitle = ({sender: {name, surname, role}, position}) => {
    let smallT = document.querySelector(".small-title");
    let newDiv = document.createRange().createContextualFragment(
        `<a href="javascript:history.back();"><div class="back"></div></a>
        <button type="submit" name="submit" value="Send"></button>
        <div class="position">${position?position:role}</div>
        <div class="name">${name} ${surname}</div>
        `);
    smallT.appendChild(newDiv);
};

const addMsgTitleApplicant = ({sender: {name, surname}}) => {
    let smallT = document.querySelector(".small-title");
    let newDiv = document.createRange().createContextualFragment(
        `<a href="javascript:history.back();"><div class="back"></div></a>
        <button type="submit" name="submit" value="Send"></button>
        ${name} ${surname}
        `);
    smallT.appendChild(newDiv);
};

const addTopicEditor = ({topic, position}) => {
    const msgTopic = document.querySelector(".msg-topic");
    const parent = document.querySelector(".message-wrapper").querySelector(".form-row");
    parent.removeChild(msgTopic);
    let input = document.createRange().createContextualFragment(
        `<input type="text" class="msg-topic" value="${ position ? "Reply: "+position : topic || ""}">`);
    parent.appendChild(input);

};

const addTopic = ({topic, position}) => {
    const msgTopic = document.querySelector(".msg-topic");
    msgTopic.innerHTML = position ? "Reply: "+position : topic || "";
};