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
            date: time[i],
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

readJSON("json/replies.json");