var sidebar=document.querySelector(".sidebar");
var menu=document.querySelector(".menu-btn");
var maincontent=document.querySelector(".main-content");
var header=document.querySelector(".header-content");

menu.addEventListener('click',function(){
    if (header.style.width!="100%")
    { 
        sidebar.style.transform="translateX(-345px)";
        header.style.width="100%";
        header.style.transform="translateX(-345px)";
        maincontent.style.marginLeft ="0";
    }
    else
    {
        sidebar.style.transform="translateX(0)";
        header.style.width="calc(100% - 345px)";
        header.style.transform="translateX(0)";
        setTimeout(function() {maincontent.style.marginLeft ="345px"}, 200);
    }
});