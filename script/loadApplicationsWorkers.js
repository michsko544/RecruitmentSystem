const fromJsonToApplications = (json) => {
    const pos = json.applications.position;
    const firstName = json.applications.personalData.name;
    const lastName = json.applications.personalData.surname;
    const id = json.applications.personalData.idUser;
    const decision = json.applications.decision;
    const aid = json.applications.personalData.idApplication;
    const n = json.counters;

    for(let i=0; i<n.position; ++i){
        let props = {
            position: pos[i],
            name: firstName[i]+" "+lastName[i],
            decision: decision ? decision[i] : "" || "",
            id: id[i],
            aid: aid[i]
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