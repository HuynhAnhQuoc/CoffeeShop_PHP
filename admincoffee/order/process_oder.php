<?php 
    require_once("../connect.php");
    $comm = "SELECT status FROM oder WHERE id_oder = '".$_POST['id']."'";
	$kq = mysqli_query($connect, $comm);
    $kqtk = mysqli_fetch_array($kq);
    if($kqtk['status'] == "chờ")
    {
        $sql="UPDATE oder SET status='".$_POST['status']."' WHERE id_oder='".$_POST['id']."'";
        mysqli_query($connect, $sql);
    }
    echo $kqtk['status'];
?>