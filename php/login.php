<?php

require_once('../db/mysql_credentials.php');

// Add session control, header, ...
// Open DBMS Server connection
$con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db, $mysql_port);
if(mysqli_connect_errno($con)){
    echo "Failed to connect to MySql: " . mysqli_connect_error($con);   //DEBUG
}

// Get credentials from $_POST['email'] and $_POST['pass']
// but do it IN A SECURE WAY
$email=filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL); // replace null with $_POST and sanitization
if($email !== false)
    $email=mysqli_real_escape_string($con,$email);
$password=mysqli_real_escape_string($con,trim($_POST['pass'])); // replace null with $_POST and sanitization

function login($email, $pass, $db_connection) {
    // TODO: login logic here
    $query = "SELECT * FROM Users WHERE email='".$email."'";
    $res = $db_connection->query($query);
    if($res!==false && mysqli_num_rows($res)!== 0){
        $row=mysqli_fetch_assoc($res);
        $pswd=$row['password'];
        if(password_verify($pass, $pswd)){
            // Return logged user
            mysqli_free_result($res);
            mysqli_close($db_connection);
            return $row['email'];
        }
        else{
            echo "ERROR: wrong password. <br>"; //DEBUG
        }
    }
    else{
        echo "ERROR: in database check. <br>";  //DEBUG
    }    
    mysqli_free_result($res);
    mysqli_close($db_connection);
    return false;
}

// Get user from login
$user = login($email, $password, $con);

if ($user) {
    // Welcome message
    echo "Welcome $user!";
} else {
    // Error message
    echo "Wrong email or password";
}
