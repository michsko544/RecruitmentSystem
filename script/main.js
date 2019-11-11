const hideDiv = (id) => {
    document.getElementById(id).id=id+"--hidden";
};

const showDiv = (id) => {
    document.getElementById(id).id=id.slice(0,-8);
};

const toggleBlur = (id) => {
    document.getElementById(id).classList.toggle("blur");
}