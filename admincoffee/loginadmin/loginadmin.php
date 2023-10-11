<?php session_start(); ?>
<!DOCTYPE hmtl>
<html lang="en">
<head>
    <title>ADMIN</title>
    <meta charset = "UTF8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/loginadmin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>

<form class="login-container" method="post">
        <div class="login-content">
            <h2 class="header">Đăng nhập admin</h2>
            <div class="form-text">
                <label for="username">Tên đăng nhập</label>
                <input type="text" class="sing-input" name="user" required="required" id="username" placeholder="Nhập tên đăng nhập">
                <span classs="username_error">  </span>
            </div>
            <div class="form-text">
                <label for="password">Mật khẩu</label>
                <input type="password" class="sing-input" name="pass" required="required" id="password" placeholder="Nhập mật khẩu ">
                <span classs="password_error"></span>
            </div>
            <div class="login-label">
                <input type="submit" for="username" class="submit btn-login" value="Đăng nhập"></input>
            </div>
        </div>
    </form>
    <?php
    if (isset($_POST['user']) && isset($_POST['pass'])) {
            $username = $_POST['user'];
            $password = $_POST['pass'];
            $conn = mysqli_connect("localhost", "root", "", "shop") or die("Không thể kết nối!");
            mysqli_query($conn, "SET NAMES 'utf8'");
            $comm = "select pass, level from admin where user = '".$_POST['user']."' and pass = '".$_POST['pass']."'";
            $kq = mysqli_query($conn, $comm) or die(mysqli_error($conn));
            if($p = mysqli_fetch_array($kq))
            {
                    
                $_SESSION['user'] = $_POST['user'];
                $_SESSION['level'] = $p['level'];
                echo "<script type='text/javascript'>window.location='../index.php'</script>";
            }
        }

        ?>
</body>

</html>