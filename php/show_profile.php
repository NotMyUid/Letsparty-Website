<?php

// TODO: change credentials in the db/mysql_credentials.php file
require_once('../db/mysql_credentials.php');

session_start();

// Open DBMS Server connection
$con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db,$mysql_port);
// Get profile data from database (check current session)
if(isset($_SESSION["user_id"])){
    $ID=$_SESSION["user_id"];
    $query="SELECT * FROM Users WHERE ID ='".$ID."'";
    $res = $con->query($query);
    if($res) 
    {   
        mysqli_close($con);   
        $row=mysqli_fetch_assoc($res);
        mysqli_free_result($res);
    }
    else{
        echo("Unexpected error <br>");
    }
    // TODO: format it however you like in this page that shows profile data
    
    $_SESSION["firstName"]=$row['firstName'];
    $_SESSION["lastName"]=$row['lastName'];
    
    echo "ID : ".$row['email']."<br>"; // replace null with $_POST and sanitization
    echo "First name : ".$row['firstName']."<br>"; // replace null with $_POST and sanitization
    echo "Last name : ".$row['lastName']."<br>"; // replace null with $_POST and sanitization
    session_destroy();  //DEBUG
}
else{
    header("location: ../html/EventFinder.html");
    exit;
}

