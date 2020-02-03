async function setBurgerData(path) {
    var res = await fetch(path);
    var data = await res.json();
    const role = data.role;

    loadMenu(role);
    return role;
}

const role = setBurgerData("json/role.json");

const findConversator = (json) => {
    const id = json.idLoggedUser===json.idUser[0] ? json.idUser2[0] : json.idUser[0];
    const index = json.idUser.findIndex((elem)=>elem===id);
    const name = json.userName[index];
    const surname = json.userSurname[index];
    const role = json.userRole[index];
    return {
        id,
        name,
        surname,
        role
    };
};