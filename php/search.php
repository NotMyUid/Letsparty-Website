<?php
  include '../php/getSession.php';
?>
<!DOCTYPE html>
<html>
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

    <script type="text/javascript">
            var badge=0;
            var total=0;
            var badgeSpan = document.getElementById("num");
            var badgeSpan2 = document.getElementById("num2");
            var totalSpan = document.getElementById("total");
            <?php
            if(isset($_SESSION["cart"])){
              ?>
              var cartArray= <?php echo json_encode($_SESSION["cart"], JSON_PRETTY_PRINT);?>;
              var wrapper = $('#wrapper'), container;
              Object.keys(cartArray).forEach(function (key){
                badge+=cartArray[key].quantity;
                total+=cartArray[key].price*cartArray[key].quantity;
              });
              <?php
            }
            ?>
            badgeSpan.textContent=badge;
            badgeSpan2.textContent=badge;
            totalSpan.textContent=total+"€";
    </script>

    <script type="text/javascript">
    function showCart(a){
        var cart = document.getElementById("nav-right");
        var profile = document.getElementById("profile");
        var login = document.getElementById("login");
        if(a){
          profile.style.display="block";
          login.style.display="none";
          cart.style.display="block";
        }      
        else
        {
          login.style.display="block";
          profile.style.display="none";
          cart.style.display="none";
        }
      }
    </script>


    <?php
      if(isset($row)) 
      { 
        ?>     
        <script type="text/javascript">
          showCart(true);
          </script>
        <?php
      }
      else
      {
        ?>
        <script type="text/javascript">
        showCart(false);
        </script>
        <?php
      }
    ?>


        
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