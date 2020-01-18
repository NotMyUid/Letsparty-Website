<?php
  include '../php/getSession.php';
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
      
      <ul class="search-container">
          <form action="../php/search.php">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit">Submit</button>
          </form>
      </ul>

      <ul class="navbar-right" id="nav-right">
      <li>
        <a href="#" id="cart">
          <i class="fa fa-shopping-cart"></i> Cart 
          <span class="badge" id="num"></span>
        </a>
      </li>
      
      <div class="container">
        <div class="shopping-cart">
          <div class="shopping-cart-header">
            <i class="fa fa-shopping-cart cart-icon"></i><span class="badge" id="num2"></span>
            <div class="shopping-cart-total">
              <span class="lighter-text">Total:</span>
              <span class="main-color-text" id="total"></span>
            </div>
          </div> <!--end shopping-cart-header -->

          <ul class="shopping-cart-items" id="box">
          
          <!--  
            <li class="clearfix">

            </li>
         
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
    <script src="../js/showCartBox.js"></script>

    <?php
    include '../php/cart.php';
    ?>
    

    <h1>Next Parties:</h1>       
    <div class="main">       
              <?php
              require_once('../db/mysql_credentials.php');
              //funzione che mostra i prossimi eventi
                $con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db,$mysql_port);
                if ($con->connect_error) {
                    die("Connection failed: " . $con->connect_error);
                } 
                $query="SELECT * FROM Events WHERE DATE(to_date) >= DATE(NOW()) ORDER BY from_date LIMIT 3";
                $results = $con->query($query);
                if(count($results)>0) {
                  foreach ($results as $result) {
                  // Format as you like and print search results
                  $ID=$result["ID"];
                  $name=$result["name"];
                  $image=$result["image"];
                  $from=$result["from_date"];
                  $price=$result["price"];
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
                  } else {
                      // No matches found
                      echo "No results found";
                  }
                  mysqli_free_result($results);    
                  mysqli_close($con);

              ?>
    </div>
    
    <br><br>
    
    <h2>About us: ⇩</h2>
          If you're bored and you don't have any idea about how you're going to spend the rest of the day, you are in the right place! 
          You just need to REGISTER or SIGN IN to look for all the events taking place near you. 
          <br>
          Once you register you can also decide to subscribe to the per-country-newsletter, so you couldn't miss a thing  !
          <br>
          YES, IT'S FREE!            
          <br><br><br><br>

    <div class="footer">
        <h3>Contact us: <a href="mailto:info@letsparty.staff.com">info@letsparty.staff.com</a></h3>
    </div>

  </body>
</html>
