const fromJsonToReplies = (json) => {
    const id = json.idConv;
    const names = json.fromUser;
    const role = json.fromUser.idRole;
    const pos = json.position;
    const topic = json.topic;
    const time = json.time;
    const n = json.counters;

    for(let i = 0; i<n.message; ++i){
        let name = names.name[i] + " " + names.surname[i];
        let props = {
            id: id[i],
            name,
            role: role[i].charAt(0).toUpperCase()+role[i].slice(1), //zmiana pierwszej litery na dużą
            position: pos[i],
            topic: topic[i],
            date: time[i].slice(0,10),
        };
        addReply(props);
    }
}


async function readJSON(path) {
    var res = await fetch(path);
    var data = await res.json();
    console.log(data);
    fromJsonToReplies(data);
}

async function readColleagues(path) {
    var res = await fetch(path);
    var data = await res.json();
    console.log(data);
    addChangeConversatorBtn(data);
    document.querySelector("#btn-new-message").addEventListener("click", ()=>showDiv("add-bottom-btn-form--hidden"));
    document.querySelector(".close").addEventListener("click", ()=>hideDiv("add-bottom-btn-form"));
}

async function readRole(path) {
    var res = await fetch(path);
    var data = await res.json();
    const role = data.role;
    readJSON("json/replies.json");

    if(role!=="applicant"){
        readColleagues("json/co-workers.json");
        
    }
}

readRole("json/role.json");


