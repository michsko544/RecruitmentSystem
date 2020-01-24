const fromJsonToMsg = (json) => {
        const sender = findConversator(json);
        let titleProps = {
            sender: sender,
            topic: json.topic ? json.topic[0] || "" : "",
            position: json.position ? json.position[0] || "" : ""
        };

        let topic = {
            topic: json.topic ? json.topic[0] || "" : "",
            position: json.position ? json.position[0] || "" : ""
        };

    addMsgTitle(titleProps);
    addTopicEditor(topic);
}


async function readJSON(path) {
    var res = await fetch(path);
    var data = await res.json();
    console.log(data);
    fromJsonToMsg(data);
}

readJSON("json/chat.json");