async function readRole(path) {
    var res = await fetch(path);
    var data = await res.json();
    const role = data.role;

    loadMenu(role);
    return role;
}

const role = readRole("json/role.json");