const fromJsonToChat = (json) => {

    for(let i = 0; i<n.message; ++i){
        
        let props = {
            
        };
        addMessage(props);
    }
}


async function readJSON(path) {
    var res = await fetch(path);
    var data = await res.json();
    console.log(data);
    fromJsonToChat(data);
}

readJSON("json/chat.json");