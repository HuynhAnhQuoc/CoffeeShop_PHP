<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng | Coffee Shop</title>
    <link rel="stylesheet" href="/coffee_shop/assets/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="/coffee_shop/assets/fonts/fontawesome-free-6.1.1-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/base.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/grid.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/main.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/order.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/detail-order.css">
    <link rel="stylesheet" href="/coffee_shop/assets/css/responsive.css">
    <script Defer type="text/javascript" src="/coffee_shop/assets/js/loginAction.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> -->
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
        <div class="grid">
        <?php
                $comm ="SELECT * FROM oder WHERE user='".$_GET['id']."'";
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

                if($row=mysqli_fetch_array($sql))
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
                    <div>Người nhận: '.$row['receiver'].'</div>
                    <div>Địa chỉ: '.$row['address'].'</div>
                </div>
                '.$btn.'
            </div>';

                }
            ?>
        </div>
        <div class="order-prod grid">
            <?php
                $comm ="SELECT order_details.id_prod, order_details.number, product.name, product.type, product.price FROM order_details, product WHERE order_details.id_prod=product.id and order_details.id_order='".$_GET['id']."'";
                $sql= mysqli_query($connect,$comm);
                while($row=mysqli_fetch_array($sql))
                {
                    $thanhtien=$row['number']*$row['price'];
                        
                    $thanhtien=chuyenDoi($thanhtien.'');
                    $price=chuyenDoi($row['price']);
                    echo '<div class="grid__row">
                    <div class="grid__row">
                        <img src="/coffee_shop/assets//img/menu/'.$row['type'].'/'.$row['id_prod'].'.png" alt="sản phẩm">
                        <div>
                            <p>'.$row['name'].'</p>
                            <p>x'.$row['number'].'</p>
                        </div>
                    </div>
                    <div>
                        <p>'.$thanhtien.' <sup>đ</sup></p>
                    </div>
                </div>';
                }
            ?>
                
            </div>
            <a href="order.php" class="btn btn-comeback">Quay lại</a>
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
<script Defer async type="text/javascript" src="/coffee_shop/assets/js/order.js"></script>
</html>