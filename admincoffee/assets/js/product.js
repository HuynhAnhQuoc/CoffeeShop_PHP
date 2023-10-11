var checkAll=document.querySelector(".check-all");
var checkItem=document.querySelectorAll(".check-item");
var insertbtn=document.querySelector(".insert-btn");
var insert=document.querySelector(".insert");
var btnclose=document.querySelectorAll(".btn-close");
var insertcontainer=document.querySelector(".insert-container");
var deletebtn=document.querySelector(".delete-btn");
var deleteform=document.querySelector(".delete");
var deletecontainer=document.querySelector(".delete-container");
var x=0;
var deletebtnagree=document.querySelector(".delete-btn-agree");
var inputinsert = document.querySelectorAll(".input-insert");

var updatebtn = document.querySelector(".update-btn");
var update = document.querySelector(".update");
var updatecontainer = document.querySelector(".update-container");
var upinput = document.querySelectorAll(".input-update");
var btnupOK = document.querySelector(".btn-up-OK");
var priceup = document.getElementById("price-up");
var numberup = document.getElementById("number-up");

let kiemtra = document.querySelector(".kt");
let th = kiemtra.getAttribute('kt');
var z;


if(th == 0)
{
    text = "Mã đã tồn tại!";
    openDialog(classWarning, colorWarning, text);
}
else if(th == 2)
{
    text = "File ảnh không đúng!";
    openDialog(classError, colorError, text);
}
else if(th == -1 || th == 3)
{
    text = "Bạn cần nhập thông tin sản phẩm!";
    openDialog(classWarning, colorWarning, text);
}
else if(th == 1)
{
    text = "Đã thêm sản phẩm";
    openDialog(classSuccess, colorSuccess, text);
}

checkAll.addEventListener("click", function(){
    if(this.checked)
    {
        checkItem.forEach((item,index) => {
            item.checked=true;
        });
        x = checkItem.length;
    }
    else
    {
        checkItem.forEach((item,index) => {
            item.checked=false;
        });
        x = 0;
    }
})

checkItem.forEach((item,index) => {
    item.addEventListener("click", function(){
        if(this.checked)
        {
            x++;
            upCheckAll();
        }
        else
        {
            x--;
            upCheckAll();
        }

    })
});

function upCheckAll()
{
    if(x == checkItem.length )
        checkAll.checked = true;
    else
        checkAll.checked = false;
}

insertbtn.addEventListener("click",function(){
    insert.style.display="flex";
})
btnclose.forEach((item, index)=>{
    item.addEventListener("click", function(){
        close(item.parentNode);
    })
})
insert.addEventListener("click", function(){
    close(insertcontainer);
})
insertcontainer.addEventListener("click", function(event){
    event.stopPropagation();
})
deletebtn.addEventListener("click", function(){
    deleteform.style.display="flex";
})

deleteform.addEventListener("click", function(){
    close(deletecontainer);
})
deletecontainer.addEventListener("click", function(event){
    event.stopPropagation();
})
deletebtnagree.addEventListener("click",function(){
    checkItem.forEach((item,index) => {
        if(item.checked==true)
        {
            var id = item.parentNode.parentNode.getAttribute('id-prod');
            delete_item(id);
        }
    });
    setTimeout(function() {location.reload()}, 2000);
})


updatebtn.addEventListener("click", function(){
    update.style.display = 'flex';
})

update.addEventListener("click", function(){
    close(updatecontainer);
})

updatecontainer.addEventListener("click", function(event){
    event.stopPropagation();
})

btnupOK.addEventListener("click", function(){
    z = 0;
    checkInputUpdate();
    if(z == 0)
    {
        checkItem.forEach((item,index) => {
            if(item.checked==true)
            {
                var id = item.parentNode.parentNode.getAttribute('id-prod');
                update_item(id, priceup.value, numberup.value);
            }
        });
        setTimeout(function() {location.reload()}, 2000);
    }
})

function checkInputUpdate()
{
    upinput.forEach((item, index)=>{
        if(item.value == "" && z == 0)
        {
            btnupOK.setAttribute("for", item.id);
            z = 1;
        }
    })
}

function delete_item(id) {
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "process-product.php",true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('U=delete&id='+id);
}

function update_item(id, price, number) {
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "process-product.php",true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('U=update&id='+id+'&price='+price+'&number='+number);
}

function close(item) {
    item.style.animation = "close linear .4s forwards"
    setTimeout(function(){
        item.style.animation = "show linear .4s forwards";
        item.parentNode.style.display = "none";
    }, 400);
}

// Stop Form Resubmission On Page Refresh
if (window.history.replaceState) {
    window.history.replaceState( null, null, window.location.href );
}
