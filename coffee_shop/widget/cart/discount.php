<?php
	session_start();
	include '../connect.php';
	$user = $_SESSION['username'];
	if(isset($_POST))
	{
		$comm = "select moneymin, moneyreduct from discount where id_discount = '".$_POST['id']."'";
		$kq = mysqli_query($connect, $comm);
		if($row = mysqli_fetch_array($kq, 1))
			echo $row['moneymin'].",".$row['moneyreduct'];
	}
?>