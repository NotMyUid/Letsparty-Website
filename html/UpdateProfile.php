<?php
session_start();
?>
<!DOCTYPE html> 
<html>

    <head>
        <title>Let's Party</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../css/UpdateProfile.css" rel="stylesheet">
    </head>

    <body>
        <div class="header">
            <h1>Let's Party</h1>
            <p>Find best parties in your city!</p>
        </div> 

        <div class="navbar">
            <a href="../html/Index.html">Home</a>
            <a href="../html/Cities.php">Cities</a>
            <a href="../html/show_profile.php" class="right">Profile</a>
            <div class="search-container">
                <form action="../php/search.php">
                  <input type="text" placeholder="Search.." name="search">
                  <button type="submit">Submit</button>
                </form>
              </div>
        </div>

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
                            echo "<script>window.location.href='../html/LoginAndRegistration.html'</script>";
                        }
                        mysqli_close($con);   
                    ?>
                    <form action="../php/update_profile.php" method="POST">

                        <label for="firstName">First name</label>           <input type="text" name="firstName" value=<?php echo $row["firstName"];?>>
                        <label for="lastName">Last name</label>             <input type="text" name="lastName"  value=<?php echo $row["lastName"];?>>
                        <label for="city">City</label>                      <input type="text" name="city"  value=<?php echo $row["city"];?>>
                        <label for="about_me">About me</label>               <input type="text" name="about_me"  value=<?php echo $row["about_me"];?>>
                        <input type="submit" value="Update">
                    </form>
                
            </div>
        
        </div>

        <div class="footer">
            <h3>Contact us: <a href="mailto:info@letsparty.staff.com">info@letsparty.staff.com</a></h3>
        </div>      

    </body> 
</html>
