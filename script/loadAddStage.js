const fromJsonToStage = (json) => {
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
        readJSON("json/write_msg_user.json");
        //if(recruiter) ... add etaps, add positions
    }
}

readRole("json/role.json");