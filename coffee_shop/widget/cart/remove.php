<?php
	session_start();
	include '../connect.php';
	$user = $_SESSION['username'];
	if(isset($_POST))
	{
		$comm = "DELETE FROM cart WHERE user = '".$user."' && id_prod = '".$_POST['id']."'";
		mysqli_query($connect, $comm);
	}
?>