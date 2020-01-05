const fromJsonToChat = (json) => {
    const sender = findConversator(json);
    let titleProps = {
        sender: sender,
        topic: json.topic[0],
        position: json.position[0]
    }
    const n = json.counters;
    console.log(titleProps);
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


async function readJSON(path) {
    var res = await fetch(path);
    var data = await res.json();
    console.log(data);
    fromJsonToChat(data);
}

readJSON("json/chat.json");