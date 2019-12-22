<?php

// TODO: change credentials in the db/mysql_credentials.php file
require_once('../db/mysql_credentials.php');

session_start();

// Open DBMS Server connection
$con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db,$mysql_port);
// Get profile data from database (check current session)
if(isset($_SESSION["user_id"])){
    echo($_SESSION["user_id"]); //DEBUG
    // TODO: format it however you like in this page that shows profile data
    echo $email; // replace null with $_POST and sanitization
    echo $first_name; // replace null with $_POST and sanitization
    echo $last_name; // replace null with $_POST and sanitization
    session_destroy();  //DEBUG
}
else{
    header("location: ../html/EventFinder.html");
    exit;
}

