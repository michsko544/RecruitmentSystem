const fromJsonToStage = (json) => {
    const sender = findConversator(json);
    let titleProps = {
        sender: sender,
        topic: json.topic ? json.topic[0] || "" : "",
        position: json.position ? json.position[0] || "" : ""
    };

    addStageTitle(titleProps);
}


async function readJSON(path) {
    var res = await fetch(path);
    var data = await res.json();
    console.log(data);
    fromJsonToStage(data);
}


async function readRole(path) {
    var res = await fetch(path);
    var data = await res.json();
    const role = data.role;

    if(role!=="applicant"){
        readJSON("json/chat.json");
        //if(recruiter) ... add etaps, add positions
    }
}

readRole("json/role.json");