<?php 
    require_once("../connect.php");

    if($_POST['U']=='delete')
    {
        delete_prod($_POST['id'],$connect);
    }
    if($_POST['U']=='update')
    {
        update_prod($_POST['id'], $_POST['price'], $_POST['number'],$connect);
    }
    function delete_prod($id,$connect)
    {
        $sql="DELETE FROM product WHERE id='".$id."'";
        mysqli_query($connect,$sql);
    }
    function update_prod($id,$price, $number,$connect)
    {
        $sql="UPDATE product SET price='".$price."',sum_number='".$number."' WHERE id='".$id."'";
        mysqli_query($connect,$sql);
    }
?>