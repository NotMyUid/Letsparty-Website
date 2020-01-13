<?php
    if (isset($_GET["name"])) {
        $city=$_GET["name"];
    }
    else{
        header("../html/Cities.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Let's Party: Events</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../css/Cities.css" rel="stylesheet">
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

        <h2><?php echo $city; ?> </h2>
        
        <div class="main">
            <?php
                require_once('../db/mysql_credentials.php');
                $con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db,$mysql_port);
                if ($con->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 
                $query="SELECT ID, name, image FROM Events WHERE city='".$city."' AND DATE(to_date) >= DATE(NOW())";
                $res = $con->query($query);
                if ($res->num_rows > 0) {
                    while($row = $res->fetch_assoc()) {
                        $ID=$row["ID"];
                        $image=$row["image"];
                        $name=$row["name"];
                        ?>
                        <div class="card" onclick="location.href ='../php/Event.php?ID=<?php echo $ID; ?>'"> 
                            <img src="../images/<?php echo $row["image"]; ?>.jpg" alt=<?php echo $name; ?> style="width: 100%;">
                            <h1><?php echo $name; ?></h1>
                        </div>         
                        <?php
                    }
                    mysqli_free_result($res);  
                }
                else{
                    echo "There are no events for this city.";
                }
                mysqli_close($con);   
                ?>
        </div>

        <div class="footer">
            <h3>Contact us: <a href="mailto:info@letsparty.staff.com">info@letsparty.staff.com</a></h3>
        </div>          
    </body>
</html> 
