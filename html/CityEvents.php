<?php
    include '../php/getSession.php';
    if (isset($_GET["name"])) {
        $city=$_GET["name"];
    }
    else{
        header("../html/Cities.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Let's Party</title>  
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <link rel="stylesheet" href="../css/Cities.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>

  <body>
    <div class="header"></div> 

    <!-- Navigation Bar start -->
    <nav>
    <div class="container">
      <ul class="navbar-left">
        <li><a href="../html/index.php">Home</a></li>
        <li><a href="../html/Cities.php">Cities</a></li>
        <li><a id="last" href="../html/show_profile.php">
        <p id="profile"> Profile </p>
        <p id="login"> Login </p>
        </a></li>
      </ul> <!--end navbar-left -->
      
      <form id="search" action="../html/search.php">
        <input type="text" placeholder="Search.." name="search">
        <button type="submit">Submit</button>
      </form>
      

      <div class="navbar-right" id="nav-right">
      <div>
        <a href="#" id="cart">
          <i class="fa fa-shopping-cart"></i> Cart 
          <span class="badge" id="num"></span>
        </a>
      </div>
      
      <div class="container">
        <div class="shopping-cart">
          <div class="shopping-cart-header">
            <i class="fa fa-shopping-cart cart-icon"></i><span class="badge" id="num2"></span>
            <div class="shopping-cart-total">
              <span class="lighter-text">Total:</span>
              <span class="main-color-text" id="total"></span>
            </div>
          </div> <!--end shopping-cart-header -->
          <a href="../html/Checkout.php" class="button">Checkout</a>
        </div> <!--end shopping-cart -->
      </div> <!--end container -->
      </div> <!--end navbar-right -->
      </div> <!--end container -->
    </nav>
    <!--end navbar-->
    <br><br>
    <script src="../js/showCartBox.js"></script>

        <?php
        include '../php/cart.php';
        ?>

        <h1><?php echo $city; ?> </h1>
        
        <div class="main">
            <?php
                require_once('../db/mysql_credentials.php');
                $con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db,$mysql_port);
                if ($con->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 
                $query="SELECT ID, name, image, from_date, price FROM Events WHERE city='".$city."' AND DATE(to_date) >= DATE(NOW()) ORDER BY from_date";
                $res = $con->query($query);
                if ($res->num_rows > 0) {
                    while($event = $res->fetch_assoc()) {
                        $ID=$event["ID"];
                        $image=$event["image"];
                        $name=$event["name"];
                        $from=$event["from_date"];
                        $price=$event["price"];
                        ?>
                        <div class="flip-card" onclick="location.href ='../html/Events.php?ID=<?php echo $ID; ?>'"> 
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <img src="../images/<?php echo $image; ?>.jpg" alt="<?php echo $name; ?>">
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
                    mysqli_free_result($res);  
                }
                else{
                    echo "There are no events for this city.";
                }
                mysqli_close($con);   
                ?>
        </div>

        <div class="footer2">
            <h3>Contact us: <a href="mailto:info@letsparty.staff.com">info@letsparty.staff.com</a></h3>
        </div>          
    </body>
</html> 
