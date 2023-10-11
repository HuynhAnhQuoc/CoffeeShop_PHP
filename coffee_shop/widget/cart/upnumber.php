<?php
	session_start();
	include '../connect.php';
	$user = $_SESSION['username'];
	if(isset($_POST))
	{
		$comm = "UPDATE cart SET sum='".$_POST['value']."' WHERE user = '".$user."'&& id_prod = ".$_POST['id'];
		mysqli_query($connect, $comm);
	}
	echo '0,1';
?>