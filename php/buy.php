<?php
session_start();

if(isset($_GET["cart"])){
    $cart=json_decode($_GET["cart"]);
}
else{
    header("../html/Checkout.php");
}
require_once('../db/mysql_credentials.php');

// Open DBMS Server connection
$con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db,$mysql_port);
if(mysqli_connect_errno($con)){
    echo "Failed to connect to MySql: " . mysqli_connect_error($con);
}


$sessionID=$_SESSION["ID"];
$userQuery="SELECT * from Users WHERE ID='".$sessionID."'";
$resUser=$con->query($userQuery);
$user=mysqli_fetch_assoc($resUser);


foreach($cart as $index => $prod){
    $query="INSERT INTO Tickets (user_email, event_ID) VALUES ('".$user["email"]."','".$index."')";
    $res = $con->query($query);
    echo $res;
    unset($_SESSION["cart"][$index]);
}
mysqli_close($con);
header("Location: ../html/index.php");
?>