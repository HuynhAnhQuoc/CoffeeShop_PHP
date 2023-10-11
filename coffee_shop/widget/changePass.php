<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="/coffee_shop/assets/fonts/fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/stylescart.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/base.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/grid.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/main.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/responsive.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/login.css">
    <script Defer type="text/javascript" src="/coffee_shop/assets/js/loginAction.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Đổi mật khẩu | Coffee Shop</title>
</head>
<?php
    require './site.php';
?>
<body>
    <?php
        load_header();
    ?>
    <div class="changePass">
        <div class="form-panel changePass_form">
            <label href="" class="form-close form-close--login">
                <i class="form-close__icon fas fa-times"></i>
            </label>
            <div class="form-header">
                <h1 class="form-header__title">Đổi mật khẩu</h1>
            </div>
            <div class="form-content">
                <form method="post">
                    <div class="form-group">
                        <label for="old-pass">Mật khẩu cũ</label>
                        <input id="old-pass" type="password" name="old-pass" required="required" 
                        placeholder="Nhập mật khẩu hiện tại"/>
                    </div>
                    <div class="form-group">
                        <label for="new-pass">Mật khẩu mới</label>
                        <input id="new-pass" type="password" name="new-pass" required="required"
                        placeholder="Nhập mật khẩu mới"/>
                    </div>
                    <div class="form-group">
                        <label for="new-repass">Nhập lại mật khẩu</label>
                        <input id="new-repass" type="password" name="new-repass" required="required"
                        placeholder="Nhập lại mật khẩu mới"/>
                    </div>
                    <div class="form-group form-submit">
                        <button class="form-submit__btn" type="submit">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="cart-dialog">
        <div class="dialog-content">
            <span><i class="dialog-icon fa-solid"></i></span>
            <p class="dialog-text"></p>
        </div>
    </div>
    <?php
        load_contact();
        load_footer();
        if (isset($_POST['old-pass']) && isset($_POST['new-pass']) && isset($_POST['new-repass'])) {
            $oldPass = $_POST['old-pass'];
            $newPass = $_POST['new-pass'];
            $newRepass = $_POST['new-repass'];
            $conn = mysqli_connect("localhost", "root", "", "shop") or die("Không thể kết nối!");
            mysqli_query($conn, "SET NAMES 'utf8'");
            $checkPass = mysqli_query($conn, "SELECT user, pass FROM customer WHERE user = '".$_SESSION['username']."' and pass = '$oldPass'");
            if (mysqli_num_rows($checkPass) == 0) {
                echo '
                    <div class="cart-dialog login-fail">
                        <div class="dialog-content">
                            <span login-fail__icon><i class="dialog-icon fa-solid fa-triangle-exclamation"></i></span>
                            <p class="dialog-text">Mật khẩu không chỉnh xác</p>
                        </div>
                    </div>
                ';
                exit();
            } else {
                if ($newPass !== $newRepass) {
                    echo '
                    <div class="cart-dialog login-fail">
                        <div class="dialog-content">
                            <span login-fail__icon><i class="dialog-icon fa-solid fa-triangle-exclamation"></i></span>
                            <p class="dialog-text">Nhập lại mật khẩu không chính xác</p>
                        </div>
                    </div>
                    ';
                    exit();
                } else {
                    $row = mysqli_fetch_array($checkPass);
                    mysqli_query($conn, "UPDATE customer SET pass = '$newPass' WHERE user = '".$row['user']."'");
                    echo '
                        <div class="cart-dialog login-fail">
                            <div class="dialog-content">
                                <span login-fail__icon><i class="dialog-icon fa-solid fa-check"></i></span>
                                <p class="dialog-text">Đổi mật khẩu thành công, vui lòng đăng nhập lại</p>
                            </div>
                        </div>
                    ';
                    echo "<script type='text/javascript'>setTimeout(function() {window.location='logout.php'}, 2000)</script>";
                }
            }
        }
    ?>
</body>
</html>