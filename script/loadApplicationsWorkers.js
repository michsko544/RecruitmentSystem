const fromJsonToApplications = (json) => {
    const pos = json.applications.position;
    const firstName = json.applications.personalData.name;
    const lastName = json.applications.personalData.surname;
    const id = json.applications.personalData.idUser;
    const decision = json.applications.decision;
    const n = json.counters;
    console.log("HEllo");
    for(let i=0; i<n.position; ++i){
        let props = {
            position: pos[i],
            name: firstName[i]+" "+lastName[i],
            decision: "",
            id: id[i]
        };
        
        addApplication(props);
    }
};

async function readJSON(path) {
    var res = await fetch(path);
    var data = await res.json();
    fromJsonToApplications(data);
}

readJSON("json/applications.json");