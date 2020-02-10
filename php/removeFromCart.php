<!DOCTYPE HTML>
<head>
    <meta charset="utf-8">
    <title>Let's Party!</title>
</head>

<?php
    session_start();
    if (isset($_GET["ID"])) {
        $ID=$_GET["ID"];

        if(isset($_SESSION["cart"]) && isset($_SESSION["cart"][$ID])){
            unset($_SESSION["cart"][$ID]);
            header("Location: ../html/Checkout.php");
        }
        else{
            echo "Error: The product you're trying to remove is not in your cart.";
        }
    }
?>