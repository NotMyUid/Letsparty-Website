<?php

// TODO: change credentials in the db/mysql_credentials.php file
require_once('db/mysql_credentials.php');

// Open DBMS Server connection

// Get value from $_SESSION
$email = null; // replace null with $_SESSION

// Get values from $_POST, but do it IN A SECURE WAY
$first_name = null; // replace null with $_POST and sanitization
$last_name = null; // replace null with $_POST and sanitization

// Get additional values from $_POST, but do it IN A SECURE WAY
// If you have additional values, change functions params accordingly

function update_user($email, $first_name, $last_name, $db_connection) {
    // TODO: update logic here
    
    // Return if the update was successful
    return false;
}

// Get user from login
$successful = update_user($email, $first_name, $last_name, $con);

if ($successful) {
    // Success message
    header("Location: show_profile.php");
    exit();
} else {
    // Error message
    echo "There was an error in the update process.";
}
