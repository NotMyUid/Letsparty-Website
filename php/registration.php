<?php

require_once('../db/mysql_credentials.php');

// Open DBMS Server connection
$con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db,$mysql_port);
if(mysqli_connect_errno($con)){
    echo "Failed to connect to MySql: " . mysqli_connect_error($con);
}

// Get values from $_POST, but do it IN A SECURE WAY
$email=filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL); // replace null with $_POST and sanitization
if($email !== false)
    $email=mysqli_real_escape_string($con,$email);
else 
    $email=null;
$first_name=mysqli_real_escape_string($con,trim($_POST['firstname']));  // replace null with $_POST and sanitization
$last_name=mysqli_real_escape_string($con,trim($_POST['lastname']));    // replace null with $_POST and sanitization
$password=password_hash(mysqli_real_escape_string($con,trim($_POST['pass'])),PASSWORD_DEFAULT); // replace null with $_POST and sanitization
$password_confirm =mysqli_real_escape_string($con,trim($_POST['confirm'])); // replace null with $_POST and sanitization

// Get additional values from $_POST, but do it IN A SECURE WAY
// If you have additional values, change functions params accordingly

function insert_user($email, $first_name, $last_name, $password, $password_confirm, $db_connection) {
    // TODO: check if passwords match
    if($email !== null && password_verify($password_confirm,$password)){
            // TODO: registration logic here
            $query = "INSERT INTO Users(email,firstname,lastname,password) VALUES ('".$email."','".$first_name."','".$last_name."', '".$password."')";
            $res = $db_connection->query($query);
            // Return if the registration was successful
            if($res) 
            {   
                mysqli_close($db_connection);   
                return true;
            }
        }    
    mysqli_close($db_connection);
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
