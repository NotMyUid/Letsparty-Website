<?php

// TODO: change credentials in the db/mysql_credentials.php file
require_once('db/mysql_credentials.php');

// Open DBMS Server connection

// Get search string from $_GET['search']
// but do it IN A SECURE WAY
$search = null; // replace null with $_GET and sanitization

function search($search, $db_connection) {
    // TODO: search logic here
    
    // Return array of results
    return array();
}

// Get user from login
$results = search($search, $con);

if ($results) {
    foreach ($results as $result) {
       // Format as you like and print search results
       echo $result;
    }
} else {
    // No matches found
    echo "No results found";
}
