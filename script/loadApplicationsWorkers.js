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

const fromJsonToApplications2 = (json) => {
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
        
        addApplicationWithChangeDecision(props);
    }
};

async function readJSON(path) {
    var res = await fetch(path);
    var data = await res.json();
    fromJsonToApplications(data);
    console.log(data);
}

async function readJSON2(path) {
    var res = await fetch(path);
    var data = await res.json();
    fromJsonToApplications2(data);
    console.log(data);
    addChangeDecisionForm();
    console.log(document.querySelector(".change-btn"));
    document.querySelectorAll(".change-btn").forEach(elem=>elem.addEventListener("click", ()=>{
        document.querySelector("#change-decision").action=`../php/AddDecision?aid=${elem.id}`;
        showDiv("add-bottom-btn-form2--hidden")
    }));
    document.querySelector(".close2").addEventListener("click", ()=>hideDiv("add-bottom-btn-form2"));
}


async function readRole(path) {
    var res = await fetch(path);
    var data = await res.json();
    const role = data.role;
    if(role==="assistant")
    {
        readJSON("json/applications.json");
    } else {
        readJSON2("json/applications.json");
        if(role==="manager"){
            addPositionBtn();
            document.querySelector("#btn-position").addEventListener("click", ()=>showDiv("add-bottom-btn-form--hidden"));
            document.querySelector(".close").addEventListener("click", ()=>hideDiv("add-bottom-btn-form"));
        }
    }
}

readRole("json/role.json");
