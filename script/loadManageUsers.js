const fromJsonToUsers = (json) => {
    const id = json.users.idUser;
    const names = json.users;
    const login = json.users.login;
    const n = json.users.counter;


    for(let i = 0; i<n; ++i){
        let name = names.name[i] + " " + names.surname[i];
        let props = {
            name,
            login: login[i],
            id: id[i]
        };
        addUser(props);
    }
}

async function readJSON(path) {
    var res = await fetch(path);
    var data = await res.json();
    console.log(data);
    fromJsonToUsers(data);
}

readJSON("json/users_list.json");