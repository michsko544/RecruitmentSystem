const fromJsonToLogs = (json) => {
    const logs = json.serverError;

    /*logs.forEach(()=>{
        let props = {
            error: error[i]
        }
        addLog(props);
    });*/

    addLog({error: logs});
}


async function readJSON(path) {
    var res = await fetch(path);
    var data = await res.json();
    console.log(data);
    fromJsonToLogs(data);
}

readJSON("json/log.json");