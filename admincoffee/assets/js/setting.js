let input = document.querySelectorAll(".text-input");
let btnagree = document.querySelector(".btn-agree");
let passold = document.getElementById("passold");
let passnew = document.getElementById("passnew");
let repass = document.getElementById("repass");
let dung;

input.forEach((item, index)=>{
    item.addEventListener('focusout', function(){
        if(item.value=="")
        {
            item.style.border = "2px solid red";
        }
        else 
        {
            item.style.border ="none";  
        }
    })
})
btnagree.addEventListener("click" ,function(){
    dung = 0;
    uplabel();
    if(dung == 0 )
    {
        if(passnew.value == repass.value)
            upPass();
        else
        {
            text = "Nhập lại mật khẩu sai!";
            openDialog(classWarning, colorWarning, text);
        }
    }

})
function uplabel()
{
    input.forEach((item,index)=>{
        if(item.value == "" && dung == 0){
            btnagree.setAttribute("for", item.id);
            dung = 1;
        }
    })
}

function upPass() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        
        text = this.responseText;
        console.log(text);
        if(text == '1') {
            openDialog(classSuccess, colorSuccess, "Đổi mật khẩu thành công");
            setTimeout(function() {window.location.reload()}, 2000);
        }
        else
        {
            text = "Sai mật khẩu";
            openDialog(classWarning, colorWarning, text);
        }
      }
    };
    xhttp.open("POST", "uppass.php",true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('passold='+passold.value+'&passnew='+passnew.value+'&repass='+repass);
}