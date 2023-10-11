var confirmbtn = document.querySelectorAll(".confirm-btn");
var confirm = document.querySelector(".confirm")
var btnclose = document.querySelector(".btn-close");
var confirmcontent = document.querySelector(".confirm-content");
var btncomplete = document.querySelector(".btn-complete");
var btncancel = document.querySelector(".btn-cancel");
var id ;

confirmbtn.forEach((item, index)=>{
    item.addEventListener("click", function(){
        id = item.parentNode.parentNode.getAttribute('id_oder');
        confirm.style.display="flex";
    })
})

btnclose.addEventListener("click", function(){
    confirm.style.display="none";
})
confirm.addEventListener("click", function(){
    confirm.style.display="none";
})
confirmcontent.addEventListener("click", function(event){
    event.stopPropagation();
})

btncomplete.addEventListener("click", function(){
    processOder('hoàn thành',id);
    confirm.style.display="none";
})

btncancel.addEventListener("click",function(){
    processOder('hủy',id);
    confirm.style.display="none";
})

function processOder(value, id) {
    const xhttp = new XMLHttpRequest();
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
                console.log("ok");
                s = "Đơn hàng đã "+text+"!";
                openDialog(classWarning, colorWarning, s);
                setTimeout(function() {
                    window.location.reload();
                }, duration-500);
            }
      }
    };
    xhttp.open("POST", "process_oder.php",true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('status='+value+'&id='+id);
}