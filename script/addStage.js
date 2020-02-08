const addStageTitle = ({sender: {name, surname, role}, position}) => {
    let smallT = document.querySelector(".small-title");
    let newDiv = document.createRange().createContextualFragment(
        `<a href="javascript:history.back();"><div class="back"></div></a>
        <button id="add" type="submit" name="submit" value="Add-stage"></button>
        <div class="position">${position?position:role}</div>
        <div class="name">${name} ${surname}</div>
        `);
    smallT.appendChild(newDiv);
};

const addTopic = ({topic, position}) => {
    const msgTopic = document.querySelector(".msg-topic");
    msgTopic.innerHTML = position ? "Reply: "+position : topic || "";
};