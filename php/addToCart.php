<?php
    include '../php/getSession.php';
    if (isset($_GET["ID"])) {
        $ID=$_GET["ID"];
    }
    else{
        header("../html/Event.php");
    }
    if(!isset($_SESSION["cart"]))
        $_SESSION['cart'] = array();
    if(!isset($_SESSION["cart"][$ID]))
        $_SESSION['cart'][$ID] = array('image' => $event["image"], 'name' => $event["name"], "price" => $event["price"], "quantity" => 1);
    else
        $_SESSION['cart'][$ID]["quantity"]++;
    echo "<script>window.location.href='../html/index.php'</script>";          
?>