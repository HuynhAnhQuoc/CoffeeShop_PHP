<!DOCTYPE html>
<?php
    session_start();
    if (isset($_SESSION['cookieUser']) && isset($_SESSION['cookiePass'])) {
        $expire = time()+60*60*24*30;
        setcookie("username", $_SESSION['cookieUser'], $expire);
        setcookie("password", $_SESSION['cookiePass'], $expire);
    }
?>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="../assets/css/stylescart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/grid.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <script async type="text/javascript" src="../assets/js/loginAction.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Menu | Coffee Shop</title>
</head>
<?php
    require './site.php';
?>
<body>
    <!-- Header -->
    <?php
        load_header();
    ?>
    <!-- Content -->
    <div id="content">
        <div class="grid wide">
            <div class="row">
                <div class="col l-12 m-12 c-12">
                    <?php
                        load_category();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="cart-dialog">
        <div class="dialog-content">
            <span><i class="dialog-icon fa-solid"></i></span>
            <p class="dialog-text"></p>
        </div>
    </div>
    <!-- Contact && Footer -->
    <?php
        load_contact();
        load_footer();
        // Check login
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $conn = mysqli_connect("localhost", "root", "", "shop") or die("Không thể kết nối!");
            mysqli_query($conn, "SET NAMES 'utf8'");
            $check = mysqli_query($conn, "SELECT user, pass FROM customer WHERE user = '$username'");
            if (mysqli_num_rows($check) == 0) {
                echo '
                    <div class="cart-dialog login-fail">
                        <div class="dialog-content">
                            <span login-fail__icon><i class="dialog-icon fa-solid fa-triangle-exclamation"></i></span>
                            <p class="dialog-text">Tên đăng nhập không tồn tại</p>
                        </div>
                    </div>
                ';
                exit();
            } else {
                $row = mysqli_fetch_array($check);
                if ($password != $row['pass']) {
                    echo '
                        <div class="cart-dialog login-fail">
                            <div class="dialog-content">
                                <span login-fail__icon><i class="dialog-icon fa-solid fa-triangle-exclamation"></i></span>
                                <p class="dialog-text">Mật khẩu không chính xác</p>
                            </div>
                        </div>
                    ';
                    exit();
                } else {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $username;
                    if (isset($_POST['remember'])) {
                        $_SESSION['cookieUser'] = $username;
                        $_SESSION['cookiePass'] = $password;
                    } else {
                        $_SESSION['cookieUser'] = "";
                        $_SESSION['cookiePass'] = "";
                    }
                    echo "<script type='text/javascript'>window.location='menu.php'</script>";
                }
            }
        }

    ?>
    <script refer src="../assets/js/category.js"></script>
</body>
</html>