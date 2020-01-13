<!DOCTYPE html>
<html>
    <head>
        <title>Let's Party</title>
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
            <a href="../html/show_profile.php" class="right">Profile</a>
            <div class="search-container">
                <form action="../php/search.php">
                  <input type="text" placeholder="Search.." name="search">
                  <button type="submit">Submit</button>
                </form>
              </div>
        </div>


        
        <div class="main">Search results:
        <p id=p1>
            <?php
                // TODO: change credentials in the db/mysql_credentials.php file
                require_once('../db/mysql_credentials.php');

                // Open DBMS Server connection
                $con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db,$mysql_port);
                // Get search string from $_GET['search']
                // but do it IN A SECURE WAY
                $search = mysqli_real_escape_string($con,trim($_GET['search']));; // replace null with $_GET and sanitization

                function search($search, $db_connection) {
                    // TODO: search logic here
                    $query="SELECT * FROM Events WHERE name LIKE '%".$search."%' AND DATE(to_date) >= DATE(NOW()) ORDER BY from_date";
                    $array = $db_connection->query($query);
                    // Return array of results
                    return $array;
                }

                // Get user from login
                $results = search($search, $con);

                if (count($results)>0) {
                    foreach ($results as $result) {
                    // Format as you like and print search results
                    $ID=$result["ID"];
                    $name=$result["name"];
                    $image=$result["image"];
                    $from=$result["from_date"];
                    $price=$result["price"];
                    ?>
                    <div class="flip-card" onclick="location.href ='../php/Event.php?ID=<?php echo $ID; ?>'"> 
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <img src="../images/<?php echo $image; ?>.jpg" alt=<?php echo $name; ?> height="200px" width="100%" overflow="hidden">
                                    <h1><?php echo $name; ?></h1>
                                </div>
                                <div class="flip-card-back">
                                    <?php echo $name; ?>
                                    <p>From: <?php echo $from; ?></p>
                                    <p>Price: <?php if($price==null){echo "Free";}else{echo $price; echo "€";} ?></p>
                                </div> 
                            </div>   
                        </div>     
                    <?php
                    }
                    mysqli_free_result($results);    
                    mysqli_close($con);     
                } else {
                    // No matches found
                    echo "No results found";
                }
            ?>
        </p>
        </div>

        <div class="footer">
            <h3>Contact us: <a href="mailto:info@letsparty.staff.com">info@letsparty.staff.com</a></h3>
        </div>          
    </body>
</html> 