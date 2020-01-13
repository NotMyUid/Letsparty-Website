<?php
    if (isset($_GET["ID"])) {
        $ID=$_GET["ID"];
    }
    else{
        header("../html/CityEvents.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Let's Party: Event</title>
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
            <a href="../html/show_profile.php" class="right">Profile</a>
            <div class="search-container">
                <form action="../php/search.php">
                  <input type="text" placeholder="Search.." name="search">
                  <button type="submit">Submit</button>
                </form>
              </div>
        </div>

        <div class="main">
            <?php
                require_once('../db/mysql_credentials.php');
                $con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db,$mysql_port);
                if ($con->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 
                $query="SELECT * FROM Events WHERE ID='".$ID."'";
                $res = $con->query($query);
                if ($res->num_rows > 0) {
                    $row = $res->fetch_assoc()
                    ?>
                    <h1><?php echo $row['name']; ?></h1>
                    <?php
                    echo "From: ";
                    echo $row["from_date"];
                    echo "<br>";
                    echo "To: ";
                    echo $row["to_date"];
                    echo "<br>";
                    echo "Price: ";
                    echo $row["price"];
                    echo "€";
                    echo "<br>";
                    echo "City: ";
                    echo $row["city"];
                    echo "<br>";
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
