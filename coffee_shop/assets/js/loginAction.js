let dialog = document.querySelector(".cart-dialog")
let dialogIcon = document.querySelector(".dialog-icon")
let dialogText = document.querySelector(".dialog-text")
let loginBtn = document.querySelector(".navbar-login__btn")
let overlayLogin = document.querySelector(".overlay-login")
let overlayRegister = document.querySelector(".overlay-register")
let loginForm = document.querySelector(".form-login")
let closeLogin = document.querySelector(".form-close--login")
let closeRegister = document.querySelector(".form-close--register")
let linkRegister = document.querySelector(".form-to-register")
let registerForm = document.querySelector(".form-register")
let addBtns = document.querySelectorAll(".menu-btn")
let cartBtn = document.querySelector(".navbar-login__icon")
let classWarning = "fa-triangle-exclamation"
let colorWarning = "#ffb700"
let classSuccess = "fa-check"
let colorSuccess = "#19a500"
let header = document.getElementById("header")
let sideBarBtn = document.querySelector(".sidebar")
let sideBar= document.querySelector(".sidebar-menu")
let closeSidebar = document.querySelector(".overlay-sidebar")
let accountIcon = document.querySelector(".navbar-login__link")
let accountAction = document.querySelector(".account-action")


// Open login form and register form
if (loginBtn != null) {
    loginBtn.addEventListener('click', function() {
        loginForm.style.display = "block"
        loginForm.style.position = "fixed"
        overlayLogin.style.display = "block"
    })
}

if (linkRegister != null) {
    linkRegister.addEventListener('click', function() {
        close(loginForm)
        registerForm.style.display = "block"
        registerForm.style.position = "fixed"
        overlayRegister.style.display = "block"
    })
}


// Close login form and register form
if (overlayLogin != null) {
    overlayLogin.addEventListener('click', function() {
        close(loginForm)
    })
}

if (overlayRegister != null) {
    overlayRegister.addEventListener('click', function() {
        close(registerForm)
    })
}

if (closeLogin != null) {
    closeLogin.addEventListener('click', function() {
        close(loginForm)
    })
}

if (closeRegister != null) {
    closeRegister.addEventListener('click', function() {
        close(registerForm)
    })
}


// Open & close sidebar
if (sideBarBtn != null) {
    sideBarBtn.addEventListener('click', function() {
        sideBar.style.display = "block"
        sideBar.style.animation = "slideIn linear 0.4s"
        setTimeout(function() {
            closeSidebar.style.display = "block"
        }, 400)
    })
}

if (closeSidebar != null) {
    closeSidebar.addEventListener('click', function() {
        sideBar.style.animation = "slideOut linear 0.4s"
        setTimeout(function() {
            sideBar.style.display = "none"
            closeSidebar.style.display = "none"
        }, 400)
    })
}

// Event on form
if (loginForm != null) {
    loginForm.addEventListener('click', function(event) {
        event.stopPropagation()
    })
}

if (registerForm != null) {
    registerForm.addEventListener('click', function(event) {
        event.stopPropagation()
    })
}

// Display dialog and add to cart
if (loginBtn != null) {
    for (const addBtn of addBtns) {
        addBtn.addEventListener("click", function() {
            openDialog(classWarning, colorWarning, "Vui lòng đăng nhập trước khi đặt hàng")
        })
    }
    cartBtn.addEventListener("click", function() {
        openDialog(classWarning, colorWarning, "Vui lòng đăng nhập để xem giỏ hàng")
    })
} else {
    for (const addBtn of addBtns) {
        addBtn.addEventListener("click", function() {
            var xhttp = new XMLHttpRequest()
            xhttp.open("POST", "/coffee_shop/widget/addToCart.php", true)
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
            xhttp.send("id="+addBtn.getAttribute("id_product"))
            openDialog(classSuccess, colorSuccess, "Đã thêm vào giỏ hàng")
        })
    }
}

function openDialog(error, backGroundColor, text) {
    dialogIcon.classList.add(error)
    dialogIcon.parentNode.style.backgroundColor = backGroundColor
    dialogText.innerHTML = text
    dialog.style.display = "flex"
    setTimeout(function() {
        dialog.style.display = "none"
    }, 1000)
}

// Function close for modal
function close(item) {
    item.style.animation = "close linear .4s forwards"
    setTimeout(function(){
        item.style.animation = "show linear .4s forwards"
        item.parentNode.style.display = "none"
    }, 400)
}

// Header color change when scroll
    window.addEventListener('scroll', function() {
    if(window.pageYOffset > 100) {
        header.style.backgroundColor = "var(--main-color)"
    } else {
        header.style.backgroundColor = "rgba(0, 0, 0, 0.4)"
    }
})

// Stop Form Resubmission On Page Refresh
if (window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

// Display account action on mobile menu
if (accountIcon != null) {
    if (accountIcon.style.display != "block") {
        accountAction.style.display = "block"
    }
}
