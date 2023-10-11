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
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="../assets/css/stylescart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/page.css">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/grid.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script defer type="text/javascript" src="../assets/js/loginAction.js"></script>
    <title>Bánh ngọt | Coffee Shop</title>
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
                <div class="col l-3 m-12 c-12">
                    <?php
                        load_category();
                    ?>
                </div>
                <div class="col l-9 m-12 c-12">
                    <div class="row">
                        <?php
                            $conn = mysqli_connect("localhost", "root", "", "shop") or die("Không thể kết nối!");
                            mysqli_query($conn, "SET NAMES 'utf8'");
                            $kqua1 = mysqli_query($conn, "SELECT * FROM product WHERE type = 'cake'") or die(mysqli_error($conn));
                            $columnPage = 6;
                            $sodongdl = mysqli_num_rows($kqua1);
                            $soTrang = $sodongdl/$columnPage-1;
                            if(isset($_GET['page'])) {
                                $page = $_GET['page'];
                            } else {
                                $page = 0;
                            }
                            $vtpage = $page*$columnPage;
                            $kqua2 = mysqli_query($conn, "SELECT * FROM product WHERE type = 'cake' LIMIT $vtpage, $columnPage") or die(mysqli_error($conn));
                            if ($row = mysqli_fetch_array($kqua2)) {
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
                                    if (!isset($_SESSION['username'])) {
                                        echo '
                                        <div class="col l-4 m-6 c-12">
                                            <div class="menu__item products__item">
                                                <img src="../assets/img/menu/'.$type.'/'.$id.'.png" alt="" class="menu__item-img products__item-img">
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
                                        <div class="col l-4 m-6 c-12">
                                            <div class="menu__item products__item">
                                                <img src="../assets/img/menu/'.$type.'/'.$id.'.png" alt="" class="menu__item-img products__item-img">
                                                <div class="menu__item-about products__item-about">
                                                    <p class="products__item-desc">'.$name.'</p>
                                                    <p class="products__item-price">'.$strprice.'đ</p>
                                                    <button id_product = "'.$id.'" class="btn menu-btn">Thêm vào giỏ hàng</button>
                                                </div>
                                            </div>
                                        </div>
                                        ';
                                    }
                                } while ($row = mysqli_fetch_array($kqua2));
                            } else {
                                echo 'Không có bản ghi nào';
                            }
                        ?>
                    </div>
                    <div class="page page-menu">
                        <?php
                            if($page > 1)
                            {
                                $x = $page -2;
                                echo '<a href="cake.php?page='.$x.'" class="back-page"><<</a>';
                            }
                            if($page > 0)
                            {
                                $x = $page - 1;
                                echo '<a href="cake.php?page='.$x.'" class="number-page">'.($x+1).'</a>';
                            }
                            echo '<a class="number-page choose-page">'.($page+1).'</a>';
                            if($soTrang-$page > 0)
                            {
                                $x = $page + 1;
                                echo '<a href="cake.php?page='.$x.'" class="number-page">'.($x+1).'</a>';
                            }
                            if($soTrang-$page > 1)
                            {
                                $x = $page + 2;
                                echo '<a href="cake.php?page='.$x.'" class="up-page">>></a>';
                            }
                            mysqli_free_result($kqua1);
                            mysqli_free_result($kqua2);
                            mysqli_close($conn)
                        ?>
                    </div>
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
                    echo "<script type='text/javascript'>window.location='cake.php'</script>";
                }
            }
        }
    ?>
    <script src="../assets/js/category.js"></script>
</body>
</html>