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
     <link rel="stylesheet" href="../assets/css/process-admin.css">
     <link rel="stylesheet" href="../assets/css/product.css">
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
                <button class="update-btn">Sửa</button>
            </div>
            <div class="header">
                <div class="check">
                    <input class="check-all" type="checkbox" value="on">
                </div>
                <div class="flex-3">Id-Name</div>
                <div class="text">Loại</div>
                <div class="text">Đơn giá</div>
                <div class="text">Số lượng</div>
            </div>
            <?php 
                require_once("../connect.php");
                $kt= 10;
                if(isset($_POST['btn-submit']))
                    $kt = -1;
                // inset prod
                if(isset($_POST['id-prod']) && isset($_POST['name-prod']) && isset($_POST['type-prod']) && isset($_POST['price-prod']) && isset($_POST['number-prod']) && isset($_FILES['fileimg']))
                {
                    $sql="SELECT id FROM product WHERE id='".$_POST['id-prod']."'";
                    $kq=mysqli_query($connect,$sql);
                    if($s=mysqli_fetch_array($kq))
                    {
                        $kt=0;
                    }
                    else
                    {
                        list($namefile, $lat) = explode(".", $_FILES['fileimg']['name']);
                        $destination_path = getcwd().DIRECTORY_SEPARATOR;
                        $destination_path = $destination_path."../assets/img/menu/".$_POST['type-prod'];
                        if(!is_dir($destination_path))
                            mkdir($destination_path);
                        $upfile=1;
                        $target_path = $destination_path.'/'.$_POST['id-prod'].'.'.$lat;
                        if (($_FILES['fileimg']['type'] == 'image/gif') || 
                            ($_FILES['fileimg']['type'] == 'image/png') ||
                            ($_FILES['fileimg']['type'] == 'image/jpeg') && 
                            ($_FILES['fileimg']['size'] < 5120000)) 
                        {

                            if(move_uploaded_file(
                                    $_FILES['fileimg']['tmp_name'],
                                    $target_path))
                            { //thông báo upload thành công 
                            }
                        }
                        else
                            $upfile = 0;
                        if($upfile == 1)
                        {
                            $sql="INSERT INTO product(id, name, type, price, sum_number, discount, hot) VALUES ('".$_POST['id-prod']."','".$_POST['name-prod']."','".$_POST['type-prod']."','".$_POST['price-prod']."','".$_POST['number-prod']."','0', '0')" ;
                            mysqli_query($connect, $sql);
                            $kt=1;
                        }
                        else
                            $kt=2;
                    }
                }
                echo '<div class="kt" kt="'.$kt.'"></div>';

                $rowPage = 10;
                $comm ="SELECT * FROM product";
                $kq = mysqli_query($connect,$comm);
                $sodongdl = mysqli_num_rows($kq);
                $soTrang = floor($sodongdl/$rowPage-1/$rowPage);

                if(isset($_GET['page']))
                    $page = $_GET['page'];
                else
                    $page = 0;
                $vtpage = $page*$rowPage;
                $comm ="SELECT * FROM product ORDER BY type limit $vtpage, $rowPage";
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
                    $price = chuyenDoi($row['price']);
                    echo '<div class="item-prod" id-prod="'.$row['id'].'">
                    <div class="check">
                        <input class="check-item"  type="checkbox" value="on">
                    </div>
                    <table class="flex-3">
                        <tr>
                            <td class="text-id">id:</td>
                            <td>'.$row['id'].'</td>
                        </tr>
                        <tr>
                            <td class="text-name">name:</td>
                            <td>'.$row['name'].'</td>
                        </tr>
                    </table>
                    <p class="text">'.$row['type'].'</p>
                    <p class="text">'.$price.'<sup>đ</sup></p>
                    <p class="text">'.$row['sum_number'].'</p>
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
    <form action="product.php" method="post" enctype="multipart/form-data">
        <div class="insert">
            <div class="insert-container">
                <p class="insert-header">Chèn</p>
                <i class="btn-close ti-close"></i>
                <table class="insert-table">
                    <tr>
                        <td class="text-table">Id </td>
                        <td> <input type="text" class="input-insert" required="required" name="id-prod" id="id-prod" placeholder="Nhập id"></td>    
                    </tr>
                    <tr>
                        <td class="text-table">Name </td>
                        <td> <input type="text" class="input-insert" required="required" name="name-prod"  id="name-prod" placeholder="Nhập tên"></td>
                    </tr>
                    <tr>
                        <td class="text-table">Loại </td>
                        <td> <input type="text" class="input-insert" required="required" name="type-prod" id="type-prod" placeholder="Nhập loại"></td>
                    </tr>
                    <tr>
                        <td class="text-table">Đơn giá </td>
                        <td> <input type="number" class="input-insert" required="required" name="price-prod" id="price-prod" placeholder="Nhập đơn giá"></td>
                    </tr>
                    <tr>
                        <td class="text-table">Số lượng </td>
                        <td> <input type="number" class="input-insert" required="required" name="number-prod" id="number-prod" placeholder="Nhập số lượng"></td>
                    </tr>
                    <tr>
                        <td class="text-table">File ảnh </td>
                        <td> <input type="file" name="fileimg" id="fileimg" class="input-insert" required="required" size="30" ></td>
                    </tr>
                </table>
                <div class="text-btn"><button type="submit" name="btn-submit" class="btn-OK">OK</button></div>
            </div>
        </div> 
    </form>
    <!----------------delete---------------->
        <div class="delete">
            <div class="delete-container">
                <p class="insert-header">Xác nhận </p>
                <i class="btn-close ti-close"></i>
              
                       <p class="text-delete">Bạn có muốn xóa không?</p>
                   
                <div class="delete-dis"> <button class="delete-btn-agree" > Đồng ý</button></div>
            </div>
        </div>
     <!----------------update---------------->
	<div class="update">
		<div class="update-container">
			<p class="update-header">Sửa</p>
            <i class="btn-close ti-close"></i>
			<table class="update-table">
                <tr>
                    <td class="text-table">Đơn giá </td>
                    <td> <input type="number" class="input-update" id="price-up" placeholder="Nhập đơn giá"></td>    
                </tr>
                <tr>
                    <td class="text-table">Số lượng </td>
                    <td> <input type="number" class="input-update" id="number-up" placeholder="Nhập số lượng"></td>    
                </tr>
            </table>
            <div class="text-btn"><label for="price-up"class="btn-up-OK">OK</label></div>
		</div>
	</div>
    <?php
        require_once("../dialog.php");
    ?>
</body>
<script Defer async type="text/javascript" src="../assets/js/dialog.js"></script>
<script Defer async type="text/javascript" src="../assets/js/js-admin.js"></script>
<script Defer async type="text/javascript" src="../assets/js/product.js"></script>
</html>	