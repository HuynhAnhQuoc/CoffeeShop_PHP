<?php
    session_start();
    session_destroy();
    echo "<script>window.location='/coffee_shop/index.php'</script>";
?>