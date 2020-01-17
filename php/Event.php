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
<html>
  <head>
    <meta charset="UTF-8">
    <title>Let's Party</title>  
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <link rel="stylesheet" href="../css/UpdateProfile.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>

  <body background="../images/<?php echo $event["image"]; ?>.jpg">
  <div class="header"></div> 
    <!-- Navigation Bar start -->
    <nav>
    <div class="container">
      <ul class="navbar-left">
        <li><a href="../html/index.php">Home</a></li>
        <li><a href="../html/Cities.php">Cities</a></li>
        <li><a href="../html/show_profile.php" style="float: inline-end;">
        <p id="profile"> Profile </p>
        <p id="login"> Login </p>
        </a></li>
      </ul> <!--end navbar-left -->
      
      <ul class="search-container">
          <form action="../php/search.php">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit">Submit</button>
          </form>
      </ul>

      <ul class="navbar-right" id="nav-right">
      <li>
        <a href="#" id="cart" style="float: inline-end;">
          <i class="fa fa-shopping-cart"></i> Cart 
          <span class="badge" id="num"></span>
        </a>
      </li>
      
      <div class="container">
        <div class="shopping-cart" style="float: inline-end; margin-top: 5px;">
          <div class="shopping-cart-header">
            <i class="fa fa-shopping-cart cart-icon"></i><span class="badge" id="num2"></span>
            <div class="shopping-cart-total">
              <span class="lighter-text">Total:</span>
              <span class="main-color-text" id="total"></span>
            </div>
          </div> <!--end shopping-cart-header -->

          <ul class="shopping-cart-items">
          
          
            <li class="clearfix" id="box">

            </li>
          <!--  
            <li class="clearfix">
              <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/cart-item2.jpg" alt="item1" />
              <span class="item-name">KS Automatic Mechanic...</span>
              <span class="item-price">$1,249.99</span>
              <span class="item-quantity">Quantity: 01</span>
            </li>

            <li class="clearfix">
              <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/cart-item3.jpg" alt="item1" />
              <span class="item-name">Kindle, 6" Glare-Free To...</span>
              <span class="item-price">$129.99</span>
              <span class="item-quantity">Quantity: 01</span>
            </li>
          -->
          </ul> 
          <a href="#" class="button">Checkout</a>
        </div> <!--end shopping-cart -->
      </div> <!--end container -->
      </ul> <!--end navbar-right -->
      </div> <!--end container -->
    </nav>
    <!--end navbar-->
    <br><br>
    <script src="../js/index.js"></script>

    <?php
    include '../php/cart.php';
    ?>

        <div class="main">
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
