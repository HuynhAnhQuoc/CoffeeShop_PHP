<!DOCTYPE hmtl>
<html lang="en">
<head>
    <title>ShopCoffe</title>
    <meta charset = "UTF8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet"	href="../assets/css/style.css">
    <link rel="stylesheet"	href="../assets/css/dialog.css">
    <link rel="stylesheet"	href="../assets/css/ordermanagement.css">
    <link rel="stylesheet" href="../assets/css/page.css">
    <link rel="stylesheet" href="../assets/css/detail-oder.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <?php require_once("../sidebar.php") ?>
	    
      
      <div class="main-content">
      <?php require_once("../header.php") ?>
		<main>
        <?php 
                    require_once("../connect.php");
                    $comm ="SELECT * FROM oder WHERE id_oder='".$_GET['id_oder']."' GROUP BY status
                    ORDER BY id_oder DESC";
                    $sql= mysqli_query($connect,$comm);
                    function chuyenDoi($gt)
                    {
                        $str = "";
                        $n = strlen($gt);
                        while($n > 3)
                        {
                            $str = '.'.$gt[$n-3].$gt[$n-2].$gt[$n-1].$str;
                            $n = $n-3;
                        }
                        while($n > 0)
                        {
                            $str = $gt[$n-1].$str;
                            $n--;
                        }
                        return $str;
                    }
                    if($row=mysqli_fetch_array($sql))
                    {
                        $method = $row['method'];
                        $money = chuyenDoi($row['sum_price']);
                        if($row['status']=='chờ')
                            $colunm1 = '<button class="confirm-btn">Xác nhận!</button>';
                        elseif($row['status']=='hoàn thành')
                            $colunm1 = '<p class="complete-text">Hoàn thành</p>';
                        else
                            $colunm1 = '<p class="cancel-text">Hủy</p>';
                        echo '<div class="oder" id_oder="'.$row['id_oder'].'">
                        <div class="flex-status">
                            '.$colunm1.'
                        </div>
                        <div>
                            <p>30/05/2022</p>
                            <p>user: '.$row['user'].'</p>
                        </div>
                        <div class="oder-receive ">
                            <table>
                                <tr>
                                    <td>Người nhận: </td>
                                    <td>'.$row['receiver'].'</td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ:</td>
                                    <td>'.$row['address'].' </td>
                                </tr>
                                <tr>
                                    <td>Số dt:</td>
                                    <td>'.$row['phone_number'].'</td>
                                </tr>
                            </table>
                        </div>
                        <div>
                            <table>
                                <tr>
                                    <td>Số lượng:</td>
                                    <td>'.$row['sum_prod'].'</td>
                                </tr>
                                <tr>
                                    <td>Số tiền:</td>
                                    <td>'.$money.' <sup>đ</sup></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="method-oder">'.$row['method'].'</div>';
                    }
                ?>
                <div class="header">
                    <div class="flex-3">
                        Tên sản Phẩm 
                    </div>
                    <div class="flex-4">
                        Đơn giá
                    </div>
                    <div class="flex-4">
                        Số lương
                    </div>
                    <div class="flex-4">
                        Thành tiền 
                    </div>
               </div>   
                 <?php
                    $comm1 ="select product.name, product.price,order_details.number FROM product,order_details where product.id=order_details.id_prod and order_details.id_order='".$_GET['id_oder']."'";
                    $kq=mysqli_query($connect,$comm1);
                    while($row=mysqli_fetch_array($kq))
                    {
                        
                        $thanhtien=$row['number']*$row['price'];
                        
                        $thanhtien=chuyenDoi($thanhtien.'');
                        $price=chuyenDoi($row['price']);
                    
                        echo '<div class="item">
                        <div class="flex-3">'.$row['name'].'</div>
                        <div class="flex-4">'.$price.'<sup>đ</sup></div>
                        <div class="flex-4">'.$row['number'].'</div>
                        <div class="flex-4">'.$thanhtien.'<sup>đ</sup></div>
                        </div>';
                    }   
               ?>
            					
		</main>
      </div>
      <!-- ----------------------confirm---------------------- -->
      <div class="confirm">
            <div class="confirm-content">
                <p class="header-confirm">Xác nhận </p>
                <i class="btn-close ti-close"></i>
                <p>Hoàn thành: Đơn hàng</p>
                <p>Hủy: Hủy bỏ đơn hàng</P>
                <div class="btn-confirm">
                    <button class="btn-complete">Hoàn thành</button>
                    <button class="btn-cancel">Hủy đơn</button>
                </div>
            </div>
        </div>	  
        <?php
            require_once("../dialog.php");
        ?>
</body>
<script async type="text/javascript" src="../assets/js/dialog.js"></script>
<script async type="text/javascript" src="../assets/js/js-admin.js"></script>
<script async type="text/javascript" src="../assets/js/oder.js"></script>
</html>	