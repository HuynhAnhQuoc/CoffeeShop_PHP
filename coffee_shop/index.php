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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script async src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/stylescart.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <script defer type="text/javascript" src="./assets/js/loginAction.js"></script>
    <title>Coffee Shop</title>
</head>
<?php
    require './widget/site.php';
?>
<body>
    <div id="main">
        <!-- Header -->
        <?php
            load_header();
        ?>
        <!-- Slider -->
        <div id="slider">
            <div class="grid wide">
                <div class="slider__content">
                    <p class="slider__content-title">Cà phê,</p>
                    <p class="slider__content-title">khởi đầu của mọi ý tưởng.</p>
                    <a href="#about" class="btn">Xem thêm</a>
                </div>
            </div>
        </div>
        <!-- About -->
        <div id="about">
            <div class="grid wide">
                <p class="title">
                    <span style="color: var(--sub-color);">Giới thiệu</span>
                    về chúng tôi
                </p>
                <div class="row">
                    <div class="col wide l-6 m-12 c-12">
                        <img src="./assets/img/coffee-background-832097.jpg" alt="" class="about__img-link">
                    </div>
                    <div class="col wide l-6 m-12 c-12">
                        <div class="about__desc">
                            <p class="about__desc-content">
                                Từ tình yêu với Việt Nam và niềm đam mê cà phê, năm 2022, 
                                thương hiệu Coffee Shop ra đời với khát vọng 
                                nâng tầm di sản cà phê lâu đời của Việt Nam và lan rộng 
                                tinh thần tự hào, kết nối hài hoà giữa truyền thống với 
                                hiện đại.
                            </p>
                            <p class="about__desc-content">
                                Qua một chặng đường dài, chúng tôi đã không ngừng mang đến 
                                những sản phẩm cà phê thơm ngon, sánh đượm trong không gian 
                                thoải mái và lịch sự. Những ly cà phê của chúng tôi không chỉ 
                                đơn thuần là thức uống quen thuộc mà còn mang trên mình một 
                                sứ mệnh văn hóa phản ánh một phần nếp sống hiện đại của 
                                người Việt Nam.
                            </p>
                            <p class="about__desc-content">
                                Đến nay, Coffee Shop vẫn duy trì khâu phân loại cà phê 
                                bằng tay để chọn ra từng hạt cà phê chất lượng nhất, 
                                rang mới mỗi ngày và phục vụ quý khách với nụ cười rạng rỡ 
                                trên môi. Bí quyết thành công của chúng tôi là đây: 
                                không gian quán tuyệt vời, sản phẩm tuyệt hảo và dịch vụ 
                                chu đáo với mức giá phù hợp.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Menu -->
        <div id="menu">
            <div class="grid wide">
                <p class="title">Sản phẩm <span style="color: var(--sub-color)">HOT</span></p>
                <div class="row">
                    <?php
                        $conn = mysqli_connect("localhost", "root", "", "shop") or die("Không thể kết nối!");
                        mysqli_query($conn, "SET NAMES 'utf8'");
                        $kqua = mysqli_query($conn, "SELECT * FROM product");
                        if ($row = mysqli_fetch_array($kqua)) {
                            do {
                                $id = $row['id'];
                                $name = $row['name'];
                                $type = $row['type'];
                                $price = $row['price'];
                                $n = strlen($price);
                                $strprice = "";
                                while ($n > 3) {
                                    $strprice = '.'.$price[$n-3].$price[$n-2].$price[$n-1].$strprice;
                                    $n -= 3;
                                }
                                while ($n > 0) {
                                    $strprice = $price[$n-1].$strprice;
                                    $n -= 1;
                                }
                                $hot = $row['hot'];
                                if ($hot == true) {
                                    if (!isset($_SESSION['username'])) {
                                        echo '
                                        <div class="col l-4 wide m-6 c-12">
                                            <div class="menu__item products__item">
                                                <img src="./assets/img/menu/'.$type.'/'.$id.'.png" alt="" class="menu__item-img products__item-img">
                                                <div class="menu__item-about products__item-about">
                                                    <p class="products__item-desc">'.$name.'</p>
                                                    <p class="products__item-price">'.$strprice.'đ</p>
                                                    <button class="btn menu-btn">Thêm vào giỏ hàng</button>
                                                </div>
                                            </div>
                                        </div>
                                        ';
                                    } else {
                                        echo '
                                        <div class="col l-4 wide m-6 c-12">
                                            <div class="menu__item products__item">
                                                <img src="./assets/img/menu/'.$type.'/'.$id.'.png" alt="" class="menu__item-img products__item-img">
                                                <div class="menu__item-about products__item-about">
                                                    <p class="products__item-desc">'.$name.'</p>
                                                    <p class="products__item-price">'.$strprice.'đ</p>
                                                    <button id_product = "'.$id.'" class="btn menu-btn">Thêm vào giỏ hàng</button>
                                                </div>
                                            </div>
                                        </div>
                                        ';
                                    }
                                }
                            } while ($row = mysqli_fetch_array($kqua));
                        } else {
                            echo 'Không có bản ghi nào';
                        }
                        mysqli_free_result($kqua);
                        mysqli_close($conn);
                    ?>
                </div>
                <div class="menu__all">
                    <a href="/coffee_shop/widget/menu.php" class="btn menu__all-link">Xem tất cả sản phẩm</a>
                </div>
            </div>
        </div>
        <div class="cart-dialog">
            <div class="dialog-content">
                <span><i class="dialog-icon fa-solid"></i></span>
                <p class="dialog-text"></p>
            </div>
        </div>
        <!-- Contact & Footer -->
        <?php
            load_contact();
            load_footer();
        ?>
    </div>
    <?php
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
                    $_SESSION['password'] = $password;
                    if (isset($_POST['remember'])) {
                        $_SESSION['cookieUser'] = $username;
                        $_SESSION['cookiePass'] = $password;
                    } else {
                        $_SESSION['cookieUser'] = "";
                        $_SESSION['cookiePass'] = "";
                    }
                    echo "<script type='text/javascript'>window.location='index.php'</script>";
                }
            }
            mysqli_close($conn);
        }
        // Register
        if (isset($_POST['name']) && isset($_POST['reg-username']) 
            && isset($_POST['reg-password']) && isset($_POST['re-password']) && isset($_POST['phone-number'])) 
        {
            $name = $_POST['name'];
            $newUsername = $_POST['reg-username'];
            $newPassword = $_POST['reg-password'];
            $rePassword = $_POST['re-password'];
            $phoneNumber = $_POST['phone-number'];
            $conn = mysqli_connect("localhost", "root", "", "shop") or die("Không thể kết nối!");
            mysqli_query($conn, "SET NAMES 'utf8'");
            $checkUser = mysqli_query($conn, "SELECT user, pass FROM customer WHERE user = '$newUsername'");
            if (mysqli_num_rows($checkUser) > 0) {
                echo '
                    <div class="cart-dialog login-fail">
                        <div class="dialog-content">
                            <span login-fail__icon><i class="dialog-icon fa-solid fa-triangle-exclamation"></i></span>
                            <p class="dialog-text">Tên đăng nhập đã tồn tại</p>
                        </div>
                    </div>
                ';
                exit();
            } else {
                if ($newPassword !== $rePassword) {
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
                    $addUser = mysqli_query($conn, "INSERT INTO customer (user, pass, fullname, sdt) VALUES ('".$newUsername."', '".$newPassword."', '".$name."', '".$phoneNumber."')") or die(mysqli_error($conn));
                    if ($addUser) {
                        echo '
                            <div class="cart-dialog login-fail">
                                <div class="dialog-content">
                                    <span login-fail__icon><i class="dialog-icon fa-solid fa-check"></i></span>
                                    <p class="dialog-text">Đăng ký thành công</p>
                                </div>
                            </div>
                        ';
                        exit();
                    } else {
                        echo '
                            <div class="cart-dialog login-fail">
                                <div class="dialog-content">
                                    <span login-fail__icon><i class="dialog-icon fa-solid fa-triangle-exclamation"></i></span>
                                    <p class="dialog-text">Có lỗi xảy ra trong quá trình đăng ký</p>
                                </div>
                            </div>
                        ';
                        exit();
                    }
                }
            }
            mysqli_close($conn);
        }
    ?>
</body>
</html>



























<!-- Coded by LT123 -->