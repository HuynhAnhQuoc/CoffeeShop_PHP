<?php 
    require_once("../connect.php");

    if($_POST['U']=='delete')
    {
        echo "1";
        delete_discount($_POST['id'],$connect);
    }
    if($_POST['U']=='insert')
    {
        insert_discount($_POST['id'],$connect, $_POST['moneymin'], $_POST['moneyreduct']);
    }
    function delete_discount($id,$connect)
    {
        $sql="DELETE FROM discount WHERE id_discount='".$id."'";
        mysqli_query($connect,$sql);
    }
    function insert_discount($id,$connect,$moneymin,$moneyreduct)
    {
        $sql="SELECT id_discount FROM discount WHERE id_discount='".$id."'";
        $kq=mysqli_query($connect,$sql);
        if($s=mysqli_fetch_array($kq))
        {
            echo '0';
        }
        else 
        {
            $sql="INSERT INTO discount(id_discount, moneymin, moneyreduct) VALUES ('".$id."','".$moneymin."','".$moneyreduct."')" ;
            mysqli_query($connect, $sql);
            echo '1';
        }

    }
?>