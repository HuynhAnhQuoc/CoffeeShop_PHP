<!DOCTYPE hmtl>
<html lang="en">
<head>
     <title>ShopCoffe</title>
     <meta charset = "UTF8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	 <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
     <link rel="stylesheet" href="../assets/fonts/themify-icons/themify-icons.css">
     <link rel="stylesheet" href="../assets/fonts/fontawesome-free-6.1.1-web/css/all.css">
	 <link rel="stylesheet"	href="../assets/css/style.css">
     <link rel="stylesheet"	href="../assets/css/ordermanagement.css">
     <link rel="stylesheet"	href="../assets/css/discount.css">
     <link rel="stylesheet" href="../assets/css/process-admin.css">
     <link rel="stylesheet" href="../assets/css/dialog.css">
     <link rel="stylesheet" href="../assets/css/page.css">
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
            <div class="Contaier-btn">
                <button class="insert-btn">Chèn</button>
                <button class="delete-btn">Xóa </button>
            </div>
		    <div class="header">
                <div class="check">
                    <input class="check-all" type="checkbox" value="on">
                </div>
                <div class="text">Mã giảm giá</div>
                <div class="text">Đơn hàng</div>
                <div class="text">Số tiền giảm </div>
            </div>
            
            <?php 
                require_once("../connect.php");
                
                $rowPage = 10;
                    $comm ="SELECT * FROM oder";
                    $kq = mysqli_query($connect,$comm);
                    $sodongdl = mysqli_num_rows($kq);
                    $soTrang = floor($sodongdl/$rowPage);

                    if(isset($_GET['page']))
                        $page = $_GET['page'];
                    else
                        $page = 0;
                    $vtpage = $page*$rowPage;
                $comm ="SELECT id_discount, moneymin, moneyreduct FROM discount limit $vtpage, $rowPage";
                $kq = mysqli_query($connect,$comm);

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

                while($row=mysqli_fetch_array($kq))
                {
                    $mnmin = chuyenDoi($row['moneymin']);
                    $mnr = chuyenDoi($row['moneyreduct']);
                    echo '<div class="item-discount">
                    <div class="check">
                        <input class="check-item"  type="checkbox" value="on">
                    </div>
                    <div class="text">'.$row['id_discount'].'</div>
                    <div class="text">'.$mnmin.' <sup>đ</sup></div>
                    <div class="text">'.$mnr.'<sup>đ</sup></div>
                </div>';   
                }

            ?>
            <div class="page">
                <?php
                    if($page > 1)
                    {
                        $x = $page -2;
                        echo '<a href="product.php?page='.$x.'" class="back-page"><<</a>';
                    }
                    if($page > 0)
                    {
                        $x = $page - 1;
                        echo '<a href="product.php?page='.$x.'" class="number-page">'.($x+1).'</a>';
                    }
                    echo '<a class="number-page choose-page">'.($page+1).'</a>';
                    if($soTrang-$page > 0)
                    {
                        $x = $page + 1;
                        echo '<a href="product.php?page='.$x.'" class="number-page">'.($x+1).'</a>';
                    }
                    if($soTrang-$page > 1)
                    {
                        $x = $page + 2;
                        echo '<a href="product.php?page='.$x.'" class="up-page">>></a>';
                    }
                ?>
            </div>
									
		</main>
      </div>
          <!----------------insert---------------->
	<div class="insert">
		<div class="insert-container">
			<p class="insert-header">Chèn</p>
            <i class="btn-close ti-close"></i>
			<table class="insert-table">
                <tr>
                    <td class="text-table">Mã giảm giá </td>
                    <td> <input type="text" class="input-insert" id="id-discount" placeholder="Nhập mã giảm giá"></td>    
                </tr>
                <tr>
                    <td class="text-table">Đơn giá giảm</td>
                    <td> <input type="number" class="input-insert" id="moneymin" placeholder="Nghìn đồng"></td>
                </tr>
                <tr>
                    <td class="text-table">Số tiền giảm </td>
                    <td> <input type="number" class="input-insert" id="moneyreduct" placeholder="Nghìn đồng"></td>
                </tr>
            </table>
            <div class="text-btn"><label for="id-discount"class="btn-OK">OK</label></div>
		</div>
	</div>  
    <!----------------delete---------------->
        <div class="delete">
            <div class="delete-container">
                <p class="insert-header">Xác nhận </p>
                <i class="btn-close ti-close"></i>
              
                       <p class="text-delete">Bạn có muốn xóa không?</p>
                   
                <div class="delete-dis"> <button class="delete-btn-agree" > Đồng ý</button></div>
            </div>
        </div>
    <?php
        require_once("../dialog.php");
    ?>
</body>
<script async type="text/javascript" src="../assets/js/js-admin.js"></script>
<script async type="text/javascript" src="../assets/js/dialog.js"></script>
<script async type="text/javascript" src="../assets/js/discount.js"></script>
</html>	