const addLog = ({error}) => {
    let lastLog = document.querySelector(".form-row");
    let container = document.querySelector("#logs");
    let newDiv = document.createRange().createContextualFragment(
        `<div class="form-row">
            ${error}
        </div>`);
    !lastLog ? container.appendChild(newDiv) : container.insertBefore(newDiv, lastLog);
}