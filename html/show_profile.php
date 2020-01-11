<?php
session_start();
?>
<!DOCTYPE html> 
<html>
    <head>
        <title>Let's Party: Your Account</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../css/ShowProfile.css" rel="stylesheet">
    </head>
    <body>
        <div class="header">
            <h1>Let's Party</h1>
            <p>Find best parties in your city!</p>
        </div> 

        <div class="navbar">
            <a href="Index.html">Home</a>
            <a href="#">Cities</a>
            <a href="#">Search</a>
            <a href="../html/show_profile.php" class="right">Profile</a>
        </div>
        <h2>
            Profile
        </h2>
        <div id="user-box">
            <div class="left">
            <?php
                require_once('../db/mysql_credentials.php');
                $con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db,$mysql_port);
                // Get profile data from database (check current session)
                if(isset($_SESSION['ID']) && !empty($_SESSION['ID']))
                {
                    $ID=$_SESSION["ID"];
                    $query="SELECT * FROM Users WHERE ID ='".$ID."'";
                    $res = $con->query($query);
                    if($res) 
                    {   
                        $row=mysqli_fetch_assoc($res);
                    }
                    mysqli_free_result($res);                                                               
                }
                else{
                    ?>
                    <script>
                        window.location.href = '../html/LoginAndRegistration.html';
                    </script>
                    <?php
                }
                mysqli_close($con);   
            ?>
            First name: <?php echo $row["firstName"] ?><br>
            Last name: <?php echo $row["lastName"] ?><br>
            City: <?php echo $row["city"] ?><br>
            About me: <?php echo $row["about_me"] ?><br>
            <p class=logout>
            <a href="../php/logout.php">Logout</a>
            </p>
            <p class=update>
            <a href="../html/UpdateProfile.php">Modify</a>
            </p>
            </div>
        </div>
        <div class="footer">
            <h2>About us: ⇩</h2>
                If you're bored and you don't have any idea about how you're going to spend the rest of the day, you are in the right place! 
                You just need to REGISTER or SIGN IN to look for all the events taking place near you. 
                <br>
                Once you register you can also decide to subscribe to the per-country-newsletter, so you couldn't miss a thing  !
                <br>
                YES, IT'S FREE!   
        </div>        
    </body>
</html>