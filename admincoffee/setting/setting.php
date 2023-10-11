<!DOCTYPE hmtl>
<html lang="en">
<head>
     <title>ADMIN</title>
     <meta charset = "UTF8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	 <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	 <link rel="stylesheet"	href="../assets/css/style.css">
     <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.1.1-web/css/all.css">
     <link rel="stylesheet"	href="../assets/css/setting.css">
     <link rel="stylesheet" href="../assets/css/dialog.css">
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <?php require_once('../sidebar.php') ?>
      
    <div class="main-content">
		<?php require_once('../header.php') ?>
		
		<main>
            <div class="setting-content">
            <p class="header-setting"> Đổi mật khẩu </p>
		    <div class="setting-text">
                <p>Mật khẩu cũ </p>
                <input type="password" class="text-input" id="passold" placeholder="Nhập mật khẩu cũ">
            </div>
            <div class="setting-text">
                <p>Mật khẩu mới </p>
                <input type="password"class="text-input" id="passnew" placeholder="Nhập mật khẩu mới">
            </div>
            <div class="setting-text">
                <p>Nhập lại mật khẩu </p>
                <input type="password"class="text-input" id="repass" placeholder="Nhập lại mật khẩu ">
            </div>
            <div class="setting-label">
                <label for="passold" class="btn-agree" >OK</label>
            </div>
            </div>
		</main>
      </div>
    <?php
        require_once("../dialog.php");
    ?>

</body>
<script async type="text/javascript" src="../assets/js/setting.js"></script>
<script async type="text/javascript" src="../assets/js/js-admin.js"></script>
<script async type="text/javascript" src="../assets/js/dialog.js"></script>
</html>