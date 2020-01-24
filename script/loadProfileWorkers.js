const fromJsonToProfileW = (json) => {
    const pD = json.personalData;
    const add = json.additional;
    const n = json.counters;
    
    let titleProps = {
    sender: {id:123, name:"John", surname:"Lemon"},
    position: "Minecrafter"//json.position ? json.position[0] || "" : ""
    }
    addProfileTitle(titleProps);


    if(n.coverLetter!==0){
        let props = {
            cl: add.coverLetter[0]
        }
        addCL(props);
    }

}


async function readJSON(path) {
    var res = await fetch(path);
    var data = await res.json();
    fromJsonToProfileW(data);
}

readJSON("json/profile.json");