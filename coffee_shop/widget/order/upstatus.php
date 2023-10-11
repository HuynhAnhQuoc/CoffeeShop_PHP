<?php
	session_start();
	include '../connect.php';
	$user = $_SESSION['username'];
	if(isset($_POST))
	{
		$comm = "SELECT status FROM oder WHERE id_oder = '".$_POST['id']."'";
		$kq = mysqli_query($connect, $comm);
        $kqtk = mysqli_fetch_array($kq);
        if($kqtk['status'] == "chờ")
        {
            $comm = "UPDATE oder SET status='hủy' WHERE id_oder = '".$_POST['id']."'";
		    mysqli_query($connect, $comm);
        }
        echo $kqtk['status'];
	}
?>