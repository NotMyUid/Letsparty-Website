<?php
    include '../php/getSession.php';
    if (isset($_GET["ID"])) {
        $ID=$_GET["ID"];
    }
    else{
        header("../html/Event.php");
    }
    require_once('../db/mysql_credentials.php');
    $con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db, $mysql_port);
    $query="SELECT * FROM Events WHERE ID='".$ID."'";
    $res = $con->query($query);
    if ($res->num_rows > 0) {
        $event = $res->fetch_assoc();
        mysqli_free_result($res); 
    }else{
      echo("Unexpected error <br>");
    }
    if(!isset($_SESSION["cart"]))
        $_SESSION['cart'] = array();
    if(!isset($_SESSION["cart"][$ID]))
        $_SESSION['cart'][$ID] = array('image' => $event["image"], 'name' => $event["name"], "price" => $event["price"], "quantity" => 1);
    else
        $_SESSION['cart'][$ID]["quantity"]++;
    echo "<script>window.location.href='../html/index.php'</script>";          
?>