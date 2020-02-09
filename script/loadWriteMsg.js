const fromJsonToMsg = (json) => {
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

        let topic = {
            topic: json.personalData.topic ? json.personalData.topic[0] || "" : "",
            position: json.personalData.position ? json.personalData.position[0] || "" : ""
        };

    addMsgTitle(titleProps);
    addTopicEditor(topic);
}

const fromJsonToMsgApplicant = (json) => {
    const sender = {
        id: json.personalData.id[0],
        name: json.personalData.name[0],
        surname: json.personalData.surname[0],
        role: json.personalData.role[0]
    };
    let titleProps = {
        sender: sender
    };

    let topic = {
        topic: json.personalData.topic ? json.personalData.topic[0] || "" : "",
        position: json.personalData.position ? json.personalData.position[0] || "" : ""
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
        readJSON("json/write_msg_user.json");
    }
    else{
        readJSON2("json/write_msg_user.json");
    }
}

readRole("json/role.json");