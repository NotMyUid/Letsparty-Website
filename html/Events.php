<?php
    include '../php/getSession.php';
    if (isset($_GET["ID"])) {
        $ID=$_GET["ID"];
    }
    else{
        header("../html/CityEvents.php");
    }
    require_once('../db/mysql_credentials.php');
    $con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db, $mysql_port);
    $query="SELECT * FROM Events WHERE ID='".$ID."'";
    $res = $con->query($query);
    if ($res->num_rows > 0) {
        $event = $res->fetch_assoc();
        mysqli_free_result($res); 
    }else{
      echo("Unexpected error <br>");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Let's Party</title>  
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <link rel="stylesheet" href="../css/UpdateProfile.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>

  <body>
    <div class="header"></div> 
              
    <script>
    document.body.background="../images/<?php echo $event["image"]; ?>.jpg"
    </script>

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

    <div class="main-event">
      <h1><?php echo $event['name']; ?></h1>
      <div id="user-box">
        <div class="left">
          <?php
          if(isset($event)){
            echo "From: ";
            echo $event["from_date"];
            echo "<br>";
            echo "To: ";
            echo $event["to_date"];
            echo "<br>";
            echo "Price: ";
            echo $event["price"];
            echo "€";
            echo "<br>";
            echo "City: ";
            echo $event["city"];
            echo "<br>"; ?>
            <button class="button" onclick="location.href ='../php/addToCart.php?eventID=<?php echo $ID; ?>'">Add to cart</button>
            <?php
          }else{
            echo "There are no events for this city.";
          }
          ?>                
        </div>
      </div>
    </div>
          
    <div class="footer">
        <h3>Contact us: <a href="mailto:info@letsparty.staff.com">info@letsparty.staff.com</a></h3>
    </div>
  </body>  
</html> 
