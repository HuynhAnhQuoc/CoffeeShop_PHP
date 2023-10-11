<?php
    include '../connect.php';
    if(isset($_POST['user']) && isset($_POST['pass']))
    {
        $comm = "select pass, level from admin where user = '".$_POST['user']."'";
        $kq = mysqli_query($connect, $comm);
        if($p = mysqli_fetch_array($kq))
        {
            if($p['pass'] == $_POST['pass'])
            {
                session_start();
                $_SESSION['user'] = $_POST['user'];
                $_SESSION['level'] = $p['level'];
                echo '1';
            }
            else
                echo '0';
        }
        else
            echo 'null';
    }
?>