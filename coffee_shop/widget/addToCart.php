<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "shop") or die("Không thể kết nối!");
    mysqli_query($conn, "SET NAMES 'utf8'");
    $check = mysqli_query($conn, "SELECT user, id_prod FROM cart WHERE user = '".$_SESSION['username']."' and id_prod = '".$_POST['id']."'") or die(mysqli_error($conn));
    if (mysqli_num_rows($check) > 0) {
        mysqli_query($conn, "UPDATE cart SET sum = sum + 1 WHERE id_prod = '".$_POST['id']."'");
    } else {
        mysqli_query($conn, "INSERT INTO cart(user, id_prod) VALUES ('".$_SESSION['username']."', '".$_POST['id']."')") or die(mysqli_error($conn));
    }
?>