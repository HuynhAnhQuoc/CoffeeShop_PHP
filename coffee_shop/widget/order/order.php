<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng | Coffee Shop</title>
    <link rel="stylesheet" href="/coffee_shop/assets/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="/coffee_shop/assets/fonts/fontawesome-free-6.1.1-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/base.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/grid.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/main.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/order.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/page.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/responsive.css">
    <script Defer type="text/javascript" src="/coffee_shop/assets/js/loginAction.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<?php
    session_start();
    require '../site.php';
?>
<body>
    <?php 
        load_header();
        include '../connect.php';
        $user = $_SESSION['username'];
    ?>
    <div class="order-container">
        <div class="grid order-grid">
            <?php
                $rowPage = 10;
                $comm ="SELECT * FROM oder WHERE user='".$user."'";
                $kq = mysqli_query($connect,$comm);
                $sodongdl = mysqli_num_rows($kq);
                $soTrang = floor($sodongdl/$rowPage);

                if(isset($_GET['page']))
                    $page = $_GET['page'];
                else
                    $page = 0;
                $vtpage = $page*$rowPage;
                $comm ="SELECT * FROM oder WHERE user='".$user."'
                ORDER BY id_oder DESC limit $vtpage, $rowPage";
                $sql= mysqli_query($connect,$comm);
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

                while($row=mysqli_fetch_array($sql))
                {
                    $thanhtoan = chuyenDoi($row['sum_price'].'');
                    $btn = "";
                    if($row['status'] == 'chờ')
                    {
                        $btn = '<button class="btn grid__column-3 btn-delete">Hủy đơn</button>';
                        $tt = "Chuẩn bị giao hàng";
                    }
                    else if($row['status'] == 'hủy')
                        $tt = "Đơn hàng đã hủy";
                    else
                        $tt = "Đã hoàn thành";
                    list($yead, $month, $day) = explode("-", $row['day_book']);
                    echo '<div class="grid__row order__row" id_order="'.$row['id_oder'].'">
                    <div class="grid__column-3">
                        <div>'.$day.'-'.$month.'-'.$yead.'</div>
                        <div>Trạng thái: '.$tt.'</div>
                    </div>
                    <div class="grid__column-3">
                        <div>Số lượng: '.$row['sum_prod'].'</div>
                        <div>Thanh toán: '.$thanhtoan.'<sup>đ</sup></div>
                    </div>
                    <div class="grid__column-3">
                        <a class="link-order" href="detail-order.php?id='.$row['id_oder'].'">Xem thêm</a>
                    </div>
                    '.$btn.'
                </div>';
                }
            ?>
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
    <?php
            load_contact();
            load_footer();
        ?>
    <!-- -------------modal---------------- -->
    <div class="modal">
        <div class="modal-container">
            <div class="modal-header">
                <div class="header-text">Hủy đơn hàng</div>
                <div class="modal-close"><i class="fa-solid fa-xmark"></i></div>
            </div>
            <div class="modal-body">
                <p class="trash-text">Bạn có muốn hủy đơn hàng này không?</p>
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
</body>
<script Defer type="text/javascript" src="/coffee_shop/assets/js/order.js"></script>
</html>