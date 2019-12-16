<?php


require_once('../db/mysql_credentials.php');

// Open DBMS Server connection
$con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db);
if(mysqli_connect_errno($con)){
    echo "Failed to connect to MySql: " . mysqli_connect_error($con);
}

// Get values from $_POST, but do it IN A SECURE WAY
$email=mysqli_real_escape_string($con,$email);  // replace null with $_POST and sanitization
$first_name=mysqli_real_escape_string($con,trim($_POST['firstName']));  // replace null with $_POST and sanitization
$last_name=mysqli_real_escape_string($con,trim($_POST['lastName']));    // replace null with $_POST and sanitization
$password=password_hash(mysqli_real_escape_string($con,trim($_POST['password'])),PASSWORD_DEFAULT); // replace null with $_POST and sanitization
$password_confirm =mysqli_real_escape_string($con,trim($_POST['confirm'])); // replace null with $_POST and sanitization

// Get additional values from $_POST, but do it IN A SECURE WAY
// If you have additional values, change functions params accordingly

function insert_user($email, $first_name, $last_name, $password, $password_confirm, $db_connection) {
    // TODO: check if passwords match
    if(password_verify($password_confirm,$password)){
        // TODO: registration logic here
        $query = "INSERT INTO '".$users."' VALUES ('".$email."','".$first_name."','".$last_name."', '".$password."')";
        $res = $con->query($query);
        // Return if the registration was successful
        if($res) return true;
    }
    return false;
}

// Get user from login
$successful = insert_user($email, $first_name, $last_name, $password, $password_confirm, $con);

if ($successful) {
    // Success message
    echo "$email registered successfully!";
} else {
    // Error message
    echo "There was an error in the registration process.";
}
