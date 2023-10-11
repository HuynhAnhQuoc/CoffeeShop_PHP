<?php
    include '../connect.php';
    session_start();
        $comm = "select pass from admin where user = '".$_SESSION['user']."'";
        $kq = mysqli_query($connect, $comm);
        if($p = mysqli_fetch_array($kq))
        {
            if($p['pass'] == $_POST['passold'])
            {
                $comm = "UPDATE admin SET pass='".$_POST['passnew']."' WHERE user = '".$_SESSION['user']."'";
                mysqli_query($connect, $comm);
                echo '1';
            }
            else
                echo '0';
        }
?>