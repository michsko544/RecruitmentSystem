const fromJsonToStages = (json,json2) => {
    const stage = json.stages.name;
    const description = json.stages.description;
    const n = json.counters;
    const name = json2.personalData.name[0] + " " + json2.personalData.surname[0];

    for(let i=0; i<n.stages; ++i){    
        let props = {
            stage: stage[i],
            description: description[i],
            name
        }
        addStage(props);
    }
}


async function readJSON(path,path2) {
    var res = await fetch(path);
    var data = await res.json();
    var res2 = await fetch(path2);
    var data2 = await res2.json();
    console.log(data,data2);
    fromJsonToStages(data,data2);
    activeRoll();
    addChangeDecisionBtn();
    document.querySelector("#change-decision-btn").addEventListener("click", ()=>showDiv("add-bottom-btn-form2--hidden"));
    document.querySelector(".close").addEventListener("click", ()=>hideDiv("add-bottom-btn-form2"));
}

readJSON("json/stage.json","json/write_msg_user.json");
activeRoll();