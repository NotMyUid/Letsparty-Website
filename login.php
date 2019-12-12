<?php

// TODO: change credentials in the db/mysql_credentials.php file
require_once('db/mysql_credentials.php');

// Add session control, header, ...
// Open DBMS Server connection
$con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db);

// Get credentials from $_POST['email'] and $_POST['pass']
// but do it IN A SECURE WAY
$email = trim($_POST["email"]); // replace null with $_POST and sanitization
$pass = trim($_POST["pass"]); // replace null with $_POST and sanitization

function login($email, $pass, $db_connection) {
    // TODO: login logic here
    $query = "SELECT * FROM '".$users."' WHERE ID='".$ID."' AND PASS='".$PASSW."'";
    $res = $con->query($query);
    // Return logged user
    $obj = mysqli_fetch_object($res);
    return $obj->ID;
}

// Get user from login
$user = login($email, $pass, $con);

if ($user) {
    // Welcome message
    echo "Welcome $user!";
} else {
    // Error message
    echo "Wrong email or password";
}
