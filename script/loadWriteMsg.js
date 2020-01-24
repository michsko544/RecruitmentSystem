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

const fromJsonToMsgApplicant = (json) => {
    const sender = findConversator(json);
    let titleProps = {
        sender: sender
    };

    let topic = {
        topic: json.topic ? json.topic[0] || "" : "",
        position: json.position ? json.position[0] || "" : ""
    };

    addMsgTitleApplicant(titleProps);
    addTopic(topic);
}


async function readJSON(path) {
    var res = await fetch(path);
    var data = await res.json();
    console.log(data);
    fromJsonToMsg(data);
}

async function readJSON2(path) {
    var res = await fetch(path);
    var data = await res.json();
    console.log(data);
    fromJsonToMsgApplicant(data);
}


async function readRole(path) {
    var res = await fetch(path);
    var data = await res.json();
    const role = data.role;

    if(role!=="applicant"){
        readJSON("json/chat.json");
        //if(recruiter) ... add etaps, add positions
    }
    else{
        readJSON2("json/chat.json");
    }
}

readRole("json/role.json");