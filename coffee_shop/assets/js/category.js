const sub_coffee = document.getElementById("category__sub-coffee");
const sub_freeze = document.getElementById("category__sub-freeze");
const sub_other = document.getElementById("category__sub-other");

function displayCoffee() {
    if (sub_coffee.style.display != "block") {
        sub_coffee.style.display = "block"
    } else {
        sub_coffee.style.display = "none"
    }
}

function displayFreeze() {
    if (sub_freeze.style.display != "block") {
        sub_freeze.style.display = "block"
    } else {
        sub_freeze.style.display = "none"
    }
}

function displayOther() {
    if (sub_other.style.display != "block") {
        sub_other.style.display = "block"
    } else {
        sub_other.style.display = "none"
    }
}