<?php
    session_start();
    if (isset($_GET["ID"])) {
        $ID=$_GET["ID"];

        if(isset($_SESSION["cart"]) && isset($_SESSION["cart"][$ID])){
            unset($_SESSION["cart"][$ID]);
            echo "<script>window.location.href='../html/Checkout.php'</script>";
        }
        else{
            echo "Error: The product you're trying to remove is not in your cart.";
        }
    }
?>