const fromJsonToStages = (json) => {
    const stage = json.stages.name;
    const description = json.stages.description;
    const n = json.counters;

    for(let i=0; i<n.stages; ++i){
        let props = {
            stage: stage[i],
            description: description[i]
        }
        addStage(props);
    }
}


async function readJSON(path) {
    var res = await fetch(path);
    var data = await res.json();
    console.log(data);
    fromJsonToStages(data);
    activeRoll();
}

readJSON("json/stage.json");