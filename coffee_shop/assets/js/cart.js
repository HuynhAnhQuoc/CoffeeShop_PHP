let ktpay = document.querySelector(".kt-pay");
let th = ktpay.getAttribute("th");
let nutTang = document.querySelectorAll(".js-plus");
let nutGiam = document.querySelectorAll(".js-minus");
let inputs = document.querySelectorAll(".quantity");
let checks = document.querySelectorAll(".check-btn");
let sumItem = document.querySelector(".total-item");
let sumItem2 = document.querySelector(".total-item-bottom");
let tongtien = document.querySelector(".total-money");
let thanhtien = document.querySelector(".result-money");
let btnpay = document.querySelector(".cart-payment");
let trashItem = document.querySelectorAll(".trash-btn");
let trashAll = document.querySelector(".trash-all-btn");
let chooseAll = document.getElementById("choose-all");
let modal = document.querySelector(".cart-modal");
let modalContainer = document.querySelector(".modal-container");
let closeModalBtn = document.querySelector(".modal-close");
let cancelModal = document.querySelector(".cancel-btn");
let agreeModal = document.querySelector(".agree-btn");
let trashText = document.querySelector(".trash-text");
let textapply = document.querySelector(".text-apply");
let apply = document.querySelector(".apply-btn");
let discountText = document.querySelector(".text-apply");
let loadCart = document.querySelector(".load-cart");
let payment = document.querySelector(".container-pay");
let formpay = document.querySelector(".form-pay");
let containerpay = document.querySelector(".container-pay");
let payclose = document.querySelector(".pay-close");
let paymoney = document.querySelector(".money-pay");
let payinput = document.querySelectorAll(".pay-input-text");
let paybuttom = document.querySelector(".btn-pay");
let confirm = document.querySelector(".pay-confirm");
let confirmcontainer = document.querySelector(".confirm-container");
let confirmclose = document.querySelector(".confirm-close");
let confirmbtnclose = document.querySelector(".pay-confirm .btn-close");
let monneypay = document.querySelector(".confirm-money");
let chooseItem = parseFloat(btnpay.getAttribute("chooseItem"));
let text1 = "Bạn có muốn loại bỏ sản phẩm này khỏi giỏ hàng không?";
let text2 = "Bạn muốn xóa tất cả phẩm khỏi giỏ hàng của bạn?";
let duration = 3000;
let colorError = "#d2691eb0";
let classError = "fa-exclamation";
let itemTrash;
let isTrashAll;
let gg = 0;
let dkg = 0;
let magg = "";
let dung;


if(chooseItem == checks.length && chooseItem != 0)
    chooseAll.checked = true;

if(th == 1)
{
    openDialog(classSuccess, colorSuccess, "Thành công");
}

nutGiam.forEach((item, index) => {
    item.addEventListener('click', function(){
        let soluong = item.nextElementSibling.children[0];
        let min = parseFloat(item.nextElementSibling.firstElementChild.getAttribute("min"));
        if(soluong.value > min)
        {
            soluong.value--;
            let conteinerItem = item.parentNode.parentNode.parentNode.parentNode;
            let giaban = conteinerItem.children[0].children[1].children[1].children[1].firstElementChild.innerHTML;
            let check = conteinerItem.children[0].children[0].firstElementChild.checked;
            if(check)
                updateMoney(-1, giaban, check);
			upNumber(conteinerItem.getAttribute("id_product"), soluong.value);
        }
        else
        {
            let text = "Số lượng tối thiểu là " + min;
            dialogIcon.classList.remove(classWarning);
            openDialog(classError, colorError, text);
        }
    })
});

nutTang.forEach((item, index) => {
    item.addEventListener('click', function(){
        let soluong = item.previousElementSibling.children[0];
        let max = parseFloat(item.previousElementSibling.firstElementChild.getAttribute("max"));
        if(soluong.value < max)
        {
            soluong.value++;
            let conteinerItem = item.parentNode.parentNode.parentNode.parentNode;
            let giaban = conteinerItem.children[0].children[1].children[1].children[1].firstElementChild.innerHTML;
            let check = conteinerItem.children[0].children[0].firstElementChild.checked;
            if(check)
            {
                updateMoney(1, giaban, check);
            }
			upNumber(conteinerItem.getAttribute("id_product"), soluong.value);
        }
        else
        {
            let text = "Số lượng tối đa là " +max;
            openDialog(classError, colorError, text);
        }
        })
});

inputs.forEach((item, index) => {
    let soluongtruoc;
    item.addEventListener('focus', function(){
        soluongtruoc = item.value;
    })
    item.addEventListener('focusout', function(){
        let soluongsau = item.value;
        let max = parseFloat(item.getAttribute("max"));
        let min = parseFloat(item.getAttribute("min"));
        if(soluongsau < min || soluongsau > max)
        {
            item.value = soluongtruoc;
            let text = "Số lượng thiểu là " + min + ", tối đa là " + max;
            openDialog(classError, colorError, text);
        }
        else{
            let conteinerItem = item.parentNode.parentNode.parentNode.parentNode.parentNode;
            let giaban = conteinerItem.children[0].children[1].children[1].children[1].firstElementChild.innerHTML;
            let check = conteinerItem.children[0].children[0].firstElementChild.checked;
            if(check){
                updateMoney(soluongsau - soluongtruoc, giaban, check);
            }
			upNumber(conteinerItem.getAttribute("id_product"), soluongsau);
        }
    })
});

checks.forEach((item, index) => {
    item.addEventListener('click', function(){
        let cartitem = item.parentNode.parentNode.parentNode;
        clickItem(cartitem, item.checked);
		updateCheck(cartitem.getAttribute("id_product"), item.checked);
        if(item.checked)
        {
            chooseItem += 1;
        }
        else
        {
            chooseItem -= 1;
        }
        updateChooseAll();
    })
});

chooseAll.addEventListener('click', function(){
    if(chooseAll.checked)
    {
        checks.forEach((item, index) => {
            if(!item.checked)
            {
                item.checked = true;
                clickItem(item.parentNode.parentNode.parentNode, item.checked);
                let cartitem = item.parentNode.parentNode.parentNode;
                updateCheck(cartitem.getAttribute("id_product"), item.checked);
            }
        });
        chooseItem = checks.length;
    }
    else
    {
        checks.forEach((item, index) => {
            if(item.checked)
            {
                item.checked = false;
                clickItem(item.parentNode.parentNode.parentNode, item.checked);
                let cartitem = item.parentNode.parentNode.parentNode;
                updateCheck(cartitem.getAttribute("id_product"), item.checked);
            }
        });
        chooseItem = 0;
    }
})

trashItem.forEach((item, index) => {
    item.addEventListener('click', function(){
        openModal(text1);
        itemTrash = item;
        isTrashAll = false;
    })
});

trashAll.addEventListener('click', function(){
    openModal(text2);
    isTrashAll = true;
})

agreeModal.addEventListener('click', function(){
    close(modalContainer);
    if(isTrashAll)
    {
        removeAll();
        setTimeout(function() {window.location.reload()}, 2000);
    }
    else{
        let cartItem = itemTrash.parentNode.parentNode.parentNode;
		removeItem(cartItem.getAttribute("id_product"));
        setTimeout(function() {window.location.reload()}, 2000);
    }
})

closeModalBtn.addEventListener('click', function(){
    close(modalContainer);
})

modal.addEventListener('click', function(){
    close(modalContainer);
})

modalContainer.addEventListener('click', function(event) {
    event.stopPropagation();
})

cancelModal.addEventListener('click', function(){
    close(modalContainer);
})

btnpay.addEventListener('click', function(){
    let soluong = parseFloat(sumItem.innerHTML);
    if(soluong == 0)
    {
        text = "Vui lòng chọn sản phẩm!";
        openDialog(classWarning, colorWarning, text);
    }
	else
	{
        payment.style.display = "flex";
        let sotien = thanhtien.innerHTML.replaceAll('.', '');
        sotien = parseFloat(sotien) + 30000;
        paymoney.value = convertMoney(sotien) + " đồng";
	}
})

formpay.addEventListener('click', function(event) {
    event.stopPropagation();
})

payment.addEventListener('click', function(){
    close(formpay);
})

payclose.addEventListener('click', function(){
    close(formpay);
})

payinput.forEach((item, index)=>{
    item.addEventListener('focusout', function(){
        if(item.value == "")
        {
            item.style.borderBottomColor = '#D2691E';
        }
        else
        {
            item.style.borderBottomColor = '#f4f4f7';
        }
    })
})

paybuttom.addEventListener('click', function(){
    dung = 0;
    upForLB(dung)
    if(dung == 0)
    {
        monneypay.innerHTML = paymoney.value;
        confirm.style.display = 'flex';
    }
})

confirmbtnclose.addEventListener('click', function(){
    close(confirmcontainer);
})

confirmclose.addEventListener('click', function(){
    close(confirmcontainer);
})

confirmcontainer.addEventListener('click', function(event) {
    event.stopPropagation();
})

confirm.addEventListener('click', function(){
    close(confirmcontainer);
})

function upForLB()
{
    payinput.forEach((item, index) => {
        if(item.value == "" && dung == 0)
        {
            paybuttom.setAttribute('for', item.id)
            item.style.borderBottomColor = '#D2691E';
            dung = 1;
        }
    })
}

apply.addEventListener('click', function(){
	if(textapply.value == "")
	{
		let text = "Vui lòng nhập mã giảm giá!"
		openDialog(classWarning, colorWarning, text);
	}
	else{
		if(textapply.value != magg)
		{
			discount(textapply.value);
		}
	}
})

function clickItem(item, check){
    let giaban = item.children[0].children[1].children[1].children[1].firstElementChild.innerHTML;
    let soluong = item.children[1].children[0].children[0].children[1].firstElementChild.value;
    updateMoney(soluong, giaban, check);
}

function updateMoney(soluong, giaban, checked)
{
    giaban = giaban.replaceAll('.', '');
    giaban = parseFloat(giaban);
    soluong = parseFloat(soluong);
    let tongtienT = parseFloat(tongtien.innerHTML.replaceAll('.', ''));
    let soluongT = parseFloat(sumItem.innerHTML);
    if(checked)
    {
        tongtienT += giaban*soluong;
        soluongT += soluong;
    }
    else
    {
        tongtienT -= giaban*soluong;
        soluongT -= soluong;
    }
    tongtien.innerHTML = convertMoney(tongtienT);
    sumItem.innerHTML = soluongT;
	if(tongtienT < dkg)
		thanhtien.innerHTML = tongtien.innerHTML;
	else
		thanhtien.innerHTML = convertMoney(tongtienT - gg);
    sumItem2.value = soluongT;
    sumItem2.innerHTML = soluongT;
}

function convertMoney(tongtien)
{
	tongtien = tongtien.toString();
    let n = tongtien.length;
    let strtong = "";
    while(n > 3)
    {
        strtong = '.' + tongtien[n-3] + tongtien[n-2] + tongtien[n-1] + strtong;
        n = n-3;
    }
    while(n > 0)
    {
        strtong = tongtien[n-1] + strtong;
        n--;
    }
	return strtong;
}

function updateChooseAll() {
    if(chooseItem == checks.length && chooseItem != 0)
        chooseAll.checked = true;
    else
        chooseAll.checked = false;
}

function openModal(text) {
    modal.style.display = "flex";
    trashText.innerHTML = text;
}

function close(item) {
    item.style.animation = "close linear .4s forwards"
    setTimeout(function(){
        item.style.animation = "show linear .4s forwards";
        item.parentNode.style.display = "none";
    }, 400);
}

function resetPay() {
    sumItem.innerHTML = "0";
    tongtien.innerHTML = "0";
    thanhtien.value = "0";
    sumItem2.innerHTML = "0";
}

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

function updateCheck(id_product, bool)
{
    let value = 0;
    if(bool == true)
        value = 1;
    var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "../cart/updatecheck.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("id='"+id_product+"'&value="+value);
}

function upCheckAll(bool)
{
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "../cart/upcheckall.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("value="+bool);
}

function upNumber(id_product, value)
{
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "../cart/upnumber.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("id='"+id_product+"'&value="+value);
}

function removeItem(id_product)
{
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "../cart/remove.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("id="+id_product);
}

function removeAll()
{
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "../cart/removeAll.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send();
}

function discount(id)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			text = this.responseText;
			let text1 = "";
			if(text == "")
			{
				text1 = "Mã giảm giá không đúng";
				openDialog(classWarning, colorWarning, text1);
				magg = id;
				gg = 0;
				dkg = 0;
				thanhtien.innerHTML = tongtien.innerHTML;
			}
			else
			{
				let thanhtienT = parseFloat(thanhtien.innerHTML.replaceAll('.', ''));
				let arr = text.split(',');
				let moneyMin = parseFloat(arr[0]);
				let money = parseFloat(arr[1]);
				if(thanhtienT >= moneyMin)
				{
					thanhtien.innerHTML = convertMoney(thanhtienT - money);
					magg = id;
					gg = money;
					dkg = moneyMin;
                    openDialog(classSuccess, colorSuccess, "Đã áp dụng thành công");
				}
				else
				{
					text1 = "Đơn hàng ít nhất là " + arr[0];
					openDialog(classWarning, colorWarning, text1);
				}
			}
		}
	};
	xhttp.open("POST", "../cart/discount.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("id="+id);
}

function openLoad()
{
    loadCart.style.display = "flex";
}

function closeLoad()
{
	loadCart.style.animation = "loadFadeOut linear .4s .6s forwards"
    setTimeout(function(){
        loadCart.style.animation = "loadFadeIn linear .4s forwards";
        loadCart.style.display = "none";
    }, 1000);
}