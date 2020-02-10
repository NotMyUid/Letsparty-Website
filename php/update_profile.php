<?php
session_start();
// TODO: change credentials in the db/mysql_credentials.php file
require_once('../db/mysql_credentials.php');
// Open DBMS Server connection
$con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db,$mysql_port);
// Get value from $_SESSION
$ID=$_SESSION["ID"];
$query="SELECT * FROM Users WHERE ID ='".$ID."'";
$res = $con->query($query);
if($res) 
{   
    $row=mysqli_fetch_assoc($res);
}
mysqli_free_result($res);
$email = $row["email"]; // replace null with $_SESSION

// Get values from $_POST, but do it IN A SECURE WAY
$first_name=mysqli_real_escape_string($con,trim($_POST['firstname']));  // replace null with $_POST and sanitization
$last_name=mysqli_real_escape_string($con,trim($_POST['lastname']));    // replace null with $_POST and sanitization
$city=mysqli_real_escape_string($con,trim($_POST['city']));    // replace null with $_POST and sanitization
$about_me=mysqli_real_escape_string($con,trim($_POST['about_me']));    // replace null with $_POST and sanitization

// Get additional values from $_POST, but do it IN A SECURE WAY
// If you have additional values, change functions params accordingly

function update_user($email, $first_name, $last_name, $city="", $about_me="", $db_connection) {
    // TODO: update logic here
    $query = "UPDATE Users SET firstname='".$first_name."', lastname='".$last_name."', city='".$city."', about_me='".$about_me."' WHERE email = '".$email."'";
    mysqli_query($db_connection,$query) or die(mysqli_error($db_connection));
    // Return if the registration was successful
    if(mysqli_affected_rows($db_connection) == 1 )
    {
        mysqli_close($db_connection); 
        // Return if the update was successful  
        return true;
    }
    else
        return false;
}

// Get user from login
$successful = update_user($email, $first_name, $last_name, $city, $about_me, $con);

if ($successful) {
    // Success message
    ?>
    <script type="text/javascript">
        window.location.href = '../html/show_profile.php';
    </script>
    <?php
} else {
    // Error message
    echo "There was an error in the update process.";
}
?>
