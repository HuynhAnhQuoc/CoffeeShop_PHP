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
var btnOK = document.querySelector(".btn-OK");
var iddis = document.getElementById("id-discount");
var moneymin = document.getElementById("moneymin");
var moneyreduct = document.getElementById("moneyreduct");
var z;


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
    close(insertcontainert);
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
            var id = item.parentNode.nextElementSibling.innerHTML;
            delete_item(id);
        }
    });
    window.location.reload();
})

btnOK.addEventListener("click", function(){
    z = 0;
    checkInputInsert();
    if(z == 0)
    {
        insert_item(iddis.value, moneymin.value, moneyreduct.value);
    }
})

function checkInputInsert()
{
    inputinsert.forEach((item, index)=>{
        if(item.value == "" && z == 0)
        {
            btnOK.setAttribute("for", item.id);
            z = 1;
        }
    })
}

function delete_item(id) {
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "process_discount.php",true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('U=delete&id='+id);
}
function insert_item(id, moneymin, moneyreduct) {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        
        text = this.responseText;
        if(text == '1')
            window.location.reload();
        else
        {
            text = "Mã đã tồn tại!";
            openDialog(classWarning, colorWarning, text);
        }
      }
    };
    xhttp.open("POST", "process_discount.php",true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('U=insert&id='+id+'&moneymin='+moneymin+'&moneyreduct='+moneyreduct);
}

function close(item) {
    item.style.animation = "close linear .4s forwards"
    setTimeout(function(){
        item.style.animation = "show linear .4s forwards";
        item.parentNode.style.display = "none";
    }, 400);
}
