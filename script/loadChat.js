const fromJsonToChat = (json) => {
    const n = json.counters;

    addConvesationTitle(titleProps);
    for(let i = 0; i<n.messages; ++i){
        let props = {
            message: json.message[i],
            date: json.time[i].slice(0,10),
            user: json.senderId[i] === json.idLoggedUser ? true : false
        };
        addMessage(props);
    }
}

const fromJsonToTitle= (json) => {
    const sender = {
        id: json.personalData.id[0],
        name: json.personalData.name[0],
        surname: json.personalData.surname[0],
        role: json.personalData.role[0]
    };
    let titleProps = {
        sender: sender,
        topic: json.personalData.topic ? json.personalData.topic[0] || "" : "",
        position: json.personalData.position ? json.personalData.position[0] || "" : ""
    };

    addConvesationTitle(titleProps);
}

async function readJSON(path) {
    var res = await fetch(path);
    var data = await res.json();
    console.log(data);
    fromJsonToChat(data);
}

async function readJSON2(path) {
    var res = await fetch(path);
    var data = await res.json();
    console.log(data);
    fromJsonToTitle(data);
}

readJSON("json/chat.json");
readJSON2("json/write_msg_user.json");

