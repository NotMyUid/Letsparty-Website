<?php


require_once('db/mysql_credentials.php');

// Open DBMS Server connection
$con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db);

// Get values from $_POST, but do it IN A SECURE WAY
$email = trim($_POST["email"]); // replace null with $_POST and sanitization
$first_name = trim($_POST["firstname"]); // replace null with $_POST and sanitization
$last_name = trim($_POST["lastname"]); // replace null with $_POST and sanitization
$password = trim($_POST["pass"]); // replace null with $_POST and sanitization
$password_confirm =trim($_POST["confirm"]); // replace null with $_POST and sanitization

// Get additional values from $_POST, but do it IN A SECURE WAY
// If you have additional values, change functions params accordingly

function insert_user($email, $first_name, $last_name, $password, $password_confirm, $db_connection) {
    // TODO: check if passwords match
    if($password == $password_confirm){
        // TODO: registration logic here
         $query = "INSERT INTO '".$users."' VALUES ('".$email."','".$password."','".$first_name."', '".$last_name."')";
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
