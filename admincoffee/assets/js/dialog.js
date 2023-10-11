// dialog
let dialog = document.querySelector(".cart-dialog");
let dialogIcon = document.querySelector(".dialog-icon");
let dialogText = document.querySelector(".dialog-text");

let duration = 3000;
let colorError = "#d2691eb0";
let colorWarning = "#ffb700";

let classError = "fa-exclamation";
let classWarning = "fa-triangle-exclamation";

let classSuccess = "fa-check";
let colorSuccess = "#19a500";

function openDialog(error, backGroundColor, text) {
    dialogIcon.classList.add(error);
    dialogIcon.parentNode.style.backgroundColor = backGroundColor;
    dialogText.innerHTML = text;
    dialog.style.display = "flex";
    setTimeout(function() {
        dialogIcon.classList.remove(error);
        dialog.style.display = "none";
    }, duration);
}