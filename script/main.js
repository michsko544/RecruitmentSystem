"use strict";

const hideDiv = (id) => {
    document.getElementById(id).id=id+"--hidden";
};

const showDiv = (id) => {
    document.getElementById(id).id=id.slice(0,-8);
};

const toggleBlur = (id) => {
    document.getElementById(id).classList.toggle("blur");
};

async function readRole(path) {
    var res = await fetch(path);
    var data = await res.json();
    const role = data.role;

    loadMenu(role);
}

readRole("json/role.json");