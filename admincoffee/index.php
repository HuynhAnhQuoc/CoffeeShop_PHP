<?php
    require_once("connect.php");
    $comm = "select count(*) from oder";
    $kq = mysqli_query($connect, $comm);
    $kqtk = mysqli_fetch_array($kq);
?>
<!DOCTYPE hmtl>
<html lang="en">
<head>
     <title>ADMIN</title>
     <meta charset = "UTF8">
	 <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	 <link rel="stylesheet"	href="./assets/css/style.css">
	 <script defer type="text/javascript" src="./assets/js/js-admin.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <?php require_once('sidebar.php') ?>
      
    <div class="main-content">
		<?php require_once('header.php') ?>
		
		<main>
		
		    <div class="cards">
				<a href="./order/order.php">
					<div class="card-single">
						<div>
							<h1><?php echo $kqtk[0]; ?></h1>
							<span><b>Đơn hàng</b></span>
						</div>
						<div>
							<span class="las la-clipboard-list"></span>
						</div>
					</div>
				</a>
				<a href="./setting/setting.php">
					<div class="card-single">
						<div>					    						
							<span><b>Quản lý tài khoản</b></span>
						</div>
						<div>
							<span class="las la-hammer"></span>
						</div>
					</div>
				</a>
				<div class="card-single">
				    <div>					   
						<span><b>Contact with us:</b><br></span>
						<span class="las la-phone-volume"></span>
						<span><b>0123456780</b><br></span>					
						<span class="las la-comment-alt"></span>
						<span><b>cntt43a@gmail.com</b></span>

					</div>
					<div>
					    <span class="las la-phone-volume"></span>
					</div>
				</div>								
			</div>
		

		</main>
      </div>
	

</body>

</html>