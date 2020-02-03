const fromJsonToProfileW = (json) => {
    const add = json.additional;
    const n = json.counters;


    if(n.coverLetter!==0){
        let props = {
            cl: add.coverLetter[0]
        }
        addCL(props);
    }

}

const fromJsonToTitle = (json) => {
    var url_string = window.location.href;
    var url = new URL(url_string);
    var id = url.searchParams.get("uid");
    let index = json.applications.personalData.idUser.findIndex(elem=>elem===id);
    console.log(index);
    let sender = {
        id,
        name: json.applications.personalData.name[index],
        surname: json.applications.personalData.surname[index]
    }
    console.log(sender);
    let titleProps = {
        sender,
        position: json.applications.position ? json.applications.position[index] : ""
    }
    addProfileTitle(titleProps);

}


async function readJSON(path) {
    var res = await fetch(path);
    var data = await res.json();
    console.log(data);
    fromJsonToProfileW(data);
}

async function readJSON2(path) {
    var res = await fetch(path);
    var data = await res.json();
    console.log(data);
    fromJsonToTitle(data);
}



async function readRole(path) {
    var res = await fetch(path);
    var data = await res.json();
    const role = data.role;
    readJSON("json/profile.json");
    readJSON2("json/applications.json");

    if(role==="recruiter" || role==="manager"){
        addStageBtn();
        viewStageBtn();
    }
}

readRole("json/role.json");
