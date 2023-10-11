let delettebtn = document.querySelectorAll(".btn-delete");
let modal = document.querySelector(".modal");
let modalcontainer = document.querySelector(".modal-container");
let modalclose = document.querySelector(".modal-close");
let cancelbtn = document.querySelector(".cancel-btn");
let agreebtn = document.querySelector(".agree-btn");

let id_order;


let duration = 3000;

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

delettebtn.forEach((item, index) =>{
    item.addEventListener('click', function(){
        modal.style.display = "flex";
        id_order = item.parentNode.getAttribute("id_order");
    })
})

modalclose.addEventListener('click', function(){
    close(modalcontainer);
})

modal.addEventListener('click', function(){
    close(modalcontainer);
})

cancelbtn.addEventListener('click', function(){
    close(modalcontainer);
})

modalcontainer.addEventListener('click', function(event) {
    event.stopPropagation();
})

agreebtn.addEventListener('click', function(){
    close(modalcontainer);
    upstatus();
})

function close(item) {
    item.style.animation = "close linear .4s forwards"
    setTimeout(function(){
        item.style.animation = "show linear .4s forwards";
        item.parentNode.style.display = "none";
    }, 400);
}

function upstatus()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			text = this.responseText;
			if(text == "chờ")
            {
                openDialog(classSuccess, colorSuccess, "Thành công");
                setTimeout(function() {
                    window.location.reload();
                }, duration-500);
            }
            else
            {
                s = "Đơn hàng đã "+text+"!";
                openDialog(classWarning, colorWarning, s);
                setTimeout(function() {
                    window.location.reload();
                }, duration-500);
            }
		}
	};
	xhttp.open("POST", "upstatus.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("id="+id_order);
}