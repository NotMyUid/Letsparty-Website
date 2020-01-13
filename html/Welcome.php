<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Let's Party: Welcome!</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../css/Index.css" rel="stylesheet">
    </head>
    <body>
        <div class="header">
            <h1>Let's Party</h1>
            <p>Find best parties in your city!</p>
        </div> 

        <div class="navbar">
            <a href="../html/Index.html">Home</a>
            <a href="../html/Cities.php">Cities</a>
            <a href="#">Search</a>
            <a href="../html/show_profile.php" class="right">Profile</a>
        </div>

        <div class="Welcome">
            <?php
                require_once('../db/mysql_credentials.php');
                $con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db,$mysql_port);
                // Get profile data from database (check current session)
                if(isset($_SESSION["ID"]))
                {
                    $ID=$_SESSION["ID"];
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
                    echo "Welcome: ".$row['firstName']."!<br>";
                }
            ?>
        </div>

        <div class="footer">
            <h2>Contact us: <a href="mailto:info@letsparty.staff.com">info@letsparty.staff.com</a></h2>
        </div>          
    </body>
</html> 
