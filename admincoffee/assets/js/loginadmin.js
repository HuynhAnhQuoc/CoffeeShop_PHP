let input = document.querySelectorAll(".sing-input");
let btnsing = document.querySelector(".btn-login");
let user = document.getElementById("username");
let pass = document.getElementById("password");
let dung;

input.forEach((item, index)=>{
    item.addEventListener('focusout', function(){
        if(item.value == "")
        {
            item.style.border = "2px solid red";
        }
        else
        {
            item.style.border = "none";
            item.nextElementSibling.style.display = "none";
        }
    })
})

btnsing.addEventListener('click', function(){
    dung = 0;
    uplabel();
    if(dung == 0)
    {
        checkUser();
    }

})

function uplabel()
{
    input.forEach((item,index)=>{
        if(item.value == "" && dung == 0){
            btnsing.setAttribute("for", item.id);
            dung = 1;
        }
    })
}

function checkUser()
{
	var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            text = this.responseText;
            console.log(text);
            if(text == 'null')
            {
                btnsing.setAttribute("for", pass.id);
                user.style.border = "2px solid red";
            }
            else
            {
                if(text == '0')
                {
                    btnsing.setAttribute("for", pass.id);
                    pass.style.border = "2px solid red";
                }
                else
                    window.location.href = "../index.php";
            }
        }
    }
    xhttp.open("POST", "process-login.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("user="+user.value+"&pass="+pass.value);
}