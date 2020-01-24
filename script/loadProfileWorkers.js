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
    let sender = findConversator(json);
    let titleProps = {
    sender: sender,
    position: json.position ? json.position[0] : ""
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

readJSON("json/profile.json");
readJSON2("json/chat.json");