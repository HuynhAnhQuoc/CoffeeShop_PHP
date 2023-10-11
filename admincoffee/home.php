<?php
    require_once("connect.php");
    $comm = "select count(*) from oder";
    $kq = mysqli_query($connect, $comm);
    $kqtk = mysqli_fetch_array($kq);
?>
<head>
	 <link rel="stylesheet"	href="./css/style.css">
</head>
<div class="cards">
    <div class="card-single">
		 <div>
			<h1><?php echo $kqtk[0]; ?></h1>
			<span><b>Đơn hàng</b></span>
		</div>
		<div>
			<span class="las la-clipboard-list"></span>
		</div>
	</div>
				
	<div class="card-single">
		<div>					    						
			<span><b>Quản lý tài khoản</b></span>
			</div>
			<div>
				<span class="las la-hammer"></span>
				</div>
			</div>
				
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