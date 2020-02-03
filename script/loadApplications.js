const fromJsonToApplications = (json) => {
    const pos = json.applications.position;
    const stat = json.applications.status;
    const n = json.counters;

    for(let i = 0; i<n.position; ++i){
        let props = {
            position: pos[i],
            status: stat[i]
        };
        addApplication(props);
    }
}


async function readJSON(path) {
    var res = await fetch(path);
    var data = await res.json();
    fromJsonToApplications(data);
}

readJSON("json/applications.json");

