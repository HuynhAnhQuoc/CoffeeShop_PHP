<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng | Coffee Shop</title>
    <link rel="stylesheet" href="/coffee_shop/assets/css/payment.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/stylescart.css">
    <link rel="stylesheet" href="/coffee_shop/assets/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="/coffee_shop/assets/fonts/fontawesome-free-6.1.1-web/css/all.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/responsizecart.css">
	<link rel="stylesheet" href="/coffee_shop/assets/css/base.css">
	<link rel="stylesheet" href="/coffee_shop/assets/css/grid.css">
	<link rel="stylesheet" href="/coffee_shop/assets/css/main.css">
	<link rel="stylesheet" href="/coffee_shop/assets/css/responsizecart.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/page.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/responsive.css">
    <script Defer type="text/javascript" src="/coffee_shop/assets/js/loginAction.js"></script>
    <script Defer type="text/javascript" src="/coffee_shop/assets/js/cart.js"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- --------------HEADER---------------- -->
	<?php
		include '../header.php';
	?>
<?php
	include '../connect.php';
	$user = $_SESSION['username'];
    $kt = 0;
	if(isset($_POST['submitpay']) && isset($_POST['receiver']))
	{
		$sql = "select count(id_oder) from oder";
		$kq = mysqli_query($connect, $sql);
		$kqrv = mysqli_fetch_array($kq);
		$idpay = $kqrv[0] + 1;
		$sql = "select cart.id_prod, cart.sum, product.price from cart, product where cart.id_prod = product.id and cart.user='".$user."' and cart.checked=1";
		$kq = mysqli_query($connect, $sql);
		$sl = 0;
		$money = 30000;
		while($row = mysqli_fetch_array($kq))
		{
			$comm = "INSERT INTO order_details(id_order, id_prod, number) VALUES ('".$idpay."','".$row['id_prod']."','".$row['sum']."')";
			mysqli_query($connect, $comm);
			$sl += $row['sum'];
			$money += $row['price']*$row['sum'];
		}

        $sql = "SELECT moneymin, moneyreduct FROM discount WHERE id_discount='".$_POST['discount']."'";
		$kq = mysqli_query($connect, $sql);
        $textdiscount = "";
        if($kqtk = mysqli_fetch_array($kq))
        {
            if($money - 30000 >= $kqtk['moneymin'])
            {
                $money -= $kqtk['moneyreduct'];
                $textdiscount = $_POST['discount'];
            }
        }

		$today = date("Y-m-d");
		$sql = "INSERT INTO `oder`(id_oder, user, sum_prod, sum_price, day_book, status, receiver, address, phone_number, method, discount) VALUES ('".$idpay."','".$user."','".$sl."','".$money."','".$today."','chờ','".$_POST['receiver']."','".$_POST['address']."','".$_POST['phone-number']."','".$_POST['method']."','".$textdiscount."')";
		mysqli_query($connect, $sql);
        $kt = 1;
        mysqli_query($connect, "DELETE FROM cart where user = '$user'");
	}
    echo '<div class="kt-pay" th="'.$kt.'"></div>';
?>
	<!-- --------------CART---------------- -->
    <section class="cart">
        <div class="container-top">
        </div>
        <form method="post">
        <div class="container-bottom">
            <div class="cart-content">
                <!-- -------------cart content left---------------- -->
                <div class="cart-content-left">
                    <div class="cart-list">
                        <!-- -------------content header let---------------- -->
                        <div class="column-name">
                            <div class="content">
                                <div class="checked"><input id="choose-all" type="checkbox" aria-checked="false" value="on"></div>
                                <div class="cart-yield">Sản phẩm</div>
                            </div>
                            <div class="footer">
                                <div class="column-number width50">Số lượng</div>
                                <div class="width50"><span class="trash-all-btn">Xóa <i class="fa-solid fa-trash-can"></i></span></div>
                            </div>
                        </div>
                        <!-- -------------list item---------------- -->
                        <?php
                            $rowPage = 4;                                
                            $comm ="select * from cart where user = '".$user."'";
                            $kq = mysqli_query($connect,$comm);
                            $sodongdl = mysqli_num_rows($kq);
                            $soTrang = $sodongdl/$rowPage-1;
            
                            if(isset($_GET['page']))
                                $page = $_GET['page'];
                            else
                                $page = 0;
                            $vtpage = $page*$rowPage;
                            $comm = "select * from cart where user = '".$user."' limit $vtpage, $rowPage";
                            $kq = mysqli_query($connect, $comm);
                            $check = 0;
                            function chuyenDoi($gt)
                            {
                                $kq = "";
                                $n = strlen($gt);
                                while($n > 3)
                                {
                                    $kq = '.'.$gt[$n-3].$gt[$n-2].$gt[$n-1].$kq;
                                    $n = $n-3;
                                }
                                while($n > 0)
                                {
                                    $kq = $gt[$n-1].$kq;
                                    $n--;
                                }
                                return $kq;
                            }
                            while($row = mysqli_fetch_array($kq, 1))
                            {
                                $sl_pro = "select name, price, sum_number, type from product where id = '".$row['id_prod']."'";
                                $sql1 = mysqli_query($connect, $sl_pro);
                                $thongtin = mysqli_fetch_array($sql1, 1);
                                $gia = chuyenDoi($thongtin['price']."");
                                if($row['checked'])
                                {
                                    $check ++;
                                }
                        ?>
                                <div class="cart-item" id_product = "<?php echo $row['id_prod']; ?>">
                                    <div class="content">
                                        <div class="checked"><input class="check-btn" type="checkbox" <?php if($row['checked'] == 1) echo 'checked';?> value="on" <?php if($thongtin['sum_number'] < $row['sum']) echo 'disabled';?>></div>
                                        <div class="cart-item-yield">
                                            <div><img src="/coffee_shop/assets/img/menu/<?php echo $thongtin['type'].'/'.$row['id_prod']; ?>.png" alt="hinh"></div>
                                            <div class="infor-item">
                                                <p><?php echo $thongtin['name']; ?></p>
                                                <div><span><?php echo $gia; ?></span><sup> đ</sup></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer footer-item">
                                        <div class="width50">
                                            <div class="cart-number">
                                                <div class="change-btn js-minus"><i class="ti-minus"></i></div>
                                                <div><input class="quantity" type="number" value="<?php echo $row['sum']; ?>" min="1" max="<?php echo $thongtin['sum_number']; ?>"></div>
                                                <div class="change-btn js-plus"><i class="ti-plus"></i></div>
                                            </div>
                                        </div>
                                        <div class="width50"><i class="trash-btn fa-solid fa-trash-can"></i></div>
                                    </div>
                                </div>
                        <?php 
                            }
                        ?>   
                    </div>
                </div>
                <!-- -------------cart content right---------------- -->
                <?php
                    $comm = "select SUM(cart.sum*product.price) AS tong, SUM(cart.sum) AS sl, count(*), checked from cart, product where cart.id_prod=product.id and cart.user = '".$user."' and checked=1 GROUP BY cart.checked";
                    $kq = mysqli_query($connect, $comm);
                    $tongtien = 0;
                    $tongsl = 0;
                    $check = 0;
                    if($row = mysqli_fetch_array($kq))
                    {
                        $tongtien = chuyenDoi($row[0].'');
                        $tongsl = $row[1];
                        $check = $row[2];
                    }
                ?>
                <div class="cart-content-pay pay-right">
                    <div class="cart-pay">
                        <div class="cart-pay-header">Thanh toán</div>
                        <div class="cart-total">
                            <div>Tổng sản phẩm</div>
                            <span class="total-item "><?php echo $tongsl; ?></span>
                        </div>
                        <div class="cart-provisional">
                            <div>Tổng tiền</div>
                            <div><span class="total-money"><?php echo $tongtien; ?></span><sup> đ</sup></div>
                        </div>
                        <div class="cart-promotion">
                            <div class="promotion-container">
                                <input class="text-apply" name="discount" type="text" placeholder="Nhập mã giãm giá">
                                <button class="apply-btn" type="button">Áp dụng</button>
                            </div>
                        </div>
                        <div class="respon-pay">
                            <div class="into-money">
                                <div>Thành tiền</div>
                                <div><span class="result-money"><?php echo $tongtien; ?></span><sup> đ</sup></div>
                            </div>
                            <div class="cart-payment" chooseItem="<?php echo $check; ?>">
                                <button class="cart-payment-btn">Thanh toán <span class="total-item-two">(<span class="total-item-bottom"><?php echo $tongsl; ?></span>) </span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page">
                <?php
                    if($page > 1)
                    {
                        $x = $page -2;
                        echo '<a href="cart.php?page='.$x.'" class="back-page"><<</a>';
                    }
                    if($page > 0)
                    {
                        $x = $page - 1;
                        echo '<a href="cart.php?page='.$x.'" class="number-page">'.($x+1).'</a>';
                    }
                    echo '<a class="number-page choose-page">'.($page+1).'</a>';
                    if($soTrang-$page > 0)
                    {
                        $x = $page + 1;
                        echo '<a href="cart.php?page='.$x.'" class="number-page">'.($x+1).'</a>';
                    }
                    if($soTrang-$page > 1)
                    {
                        $x = $page + 2;
                        echo '<a href="cart.php?page='.$x.'" class="up-page">>></a>';
                    }
                ?>
            </div>
        </div>
			<div class="container-pay">
				<div class="form-pay">
					<h2>THANH TOÁN</h2>
					<i class="pay-close fa-solid fa-xmark"></i>
					<p class="pay-text" type="Tên người nhận:"><input name="receiver" id="paytext-1" class="pay-input pay-input-text" type="text" value='' required="required"></input></p>
					<p class="pay-text" type="Địa chỉ nhận hàng:"><input name="address" id="paytext-2" class="pay-input pay-input-text" placeholder="Nhập địa chỉ cụ thể nơi nhận hàng" type="text" value='' required="required"></input></p>
					<p class="pay-text" type="Số điện thoại:"><input name="phone-number" id="paytext-3" class="pay-input pay-input-text" type="number" value='' required="required"></p>
					<p class="pay-text p-pay" type="Phương thức thanh toán:" class="p-pay"><select name="method" class="select-pay">
						<option>Thanh toán bằng thẻ tín dụng Quốc Tế</option>
						<option>Thanh toán bằng ATM</option>
						<option>Thanh toán bằng ví MOMO</option>
						<option>Thu tiền tận nơi</option>
						</select>
					</p>
					<p class="pay-text" type="Phí ship:"><input class="pay-input" type="text" value='30.000 đồng' disabled></p>
					<p class="pay-text" type="Tổng số tiền cần thanh toán:"><input class="pay-input money-pay" type="text" value="" disabled></p>
					<label for="paytext-1" class="btn-pay">Thanh Toán</label>
			</div>
			<!-- -------------pay confirm---------------- -->
			<div class="pay-confirm">
				<div class="confirm-container">
					<h2>XÁC NHẬN</h2>
					<i class="confirm-close fa-solid fa-xmark"></i>
					<p class="text-confirm">Tổng đơn hàng của bạn là <span class="confirm-money"></span></p>
					<p class="text-confirm">Bạn có đồng ý thanh toán ?</p>
					<div class="confirm-footer">
						<button name="submitpay" type="submit" class="btn-agree">Đồng ý</button>
						<button class="btn-close">Hủy</button>
					</div>
				</div>
			</div>
		</form>
    </section>
    <!-- -------------cart modal---------------- -->
    <div class="cart-modal">
        <div class="modal-container">
            <div class="modal-header">
                <div class="header-text">Xóa khỏi giỏ hàng</div>
                <div class="modal-close"><i class="fa-solid fa-xmark"></i></div>
            </div>
            <div class="modal-body">
                <p class="trash-text">Bạn có muốn loại bỏ sản phẩm này khỏi giỏ hàng không?</p>
                <div class="dialog-footer">
                    <button type="button" class="agree-btn">ĐỒNG Ý</button>
                    <button type="button" class="cancel-btn">HỦY</button>
                </div>
            </div>
        </div>
    </div>
    <!-- -------------dialog---------------- -->
    <div class="cart-dialog">
        <div class="dialog-content">
            <span><i class="dialog-icon fa-solid"></i></span>
            <p class="dialog-text"></p>
        </div>
    </div>
	<!-- -------------load---------------- -->
	<div class="load-cart"></div>
	<!-- --------------CONTACT---------------- -->
	<?php
		include '../contact.php';
	?>
	<!-- --------------FOOTER---------------- -->
	<?php
		include '../footer.php';
	?>
</body>
</html>