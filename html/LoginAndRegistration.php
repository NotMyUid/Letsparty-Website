﻿<?php
    session_start();
    require_once('../db/mysql_credentials.php');
    $con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db, $mysql_port);
    if(isset($_SESSION['ID']))
    {
      $sessionID=$_SESSION["ID"];
      $query="SELECT * FROM Users WHERE ID ='".$sessionID."'";
      $res = $con->query($query);
      if($res) 
      {      
          $row=mysqli_fetch_assoc($res);
          mysqli_free_result($res);
      }
      else{
          echo("Unexpected error <br>");
      }                 
      mysqli_close($con);
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Let's Party</title>  
    <link rel="stylesheet" href="../css/LoginAndRegistration.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>

  <body>
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
    <script src="../js/index.js"></script>

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
        
        
        <div id="login-box">
        
            <div class="signup">
                    
                    <h1>Sign up</h1>
                    
                    <form action="../php/registration.php" method="POST">
                    
                        <label for="firstname">First name</label>           <input type="text" name="firstname" placeholder="First name">
                        <label for="lastname">Last name</label>             <input type="text" name="lastname" placeholder="Last name">
                        <label for="email">E-mail</label>                   <input type="email" name="email" placeholder="E-mail">
                        <label for="pass">Password</label>                  <input type="password" name="pass" placeholder="Password">
                        <label for="confirm">Confirm Password</label>       <input type="password" name="confirm" placeholder="Retype password">

                        <!-- TODO: Add additional fields here -->

                        <input type="submit" value="Submit">
            
                    </form>
                
            </div>
                
        
            <div class="login">
                
                <span class="loginwith">Sign in</span>
                
                <form action="../php/login.php" method="POST">
                
                    Email<input type="email" name="email" placeholder="E-mail">
                    Password<input type="password" name="pass" placeholder="Password">
                
                    <input type="submit" value="Submit">
            
                </form>
            
            </div>

            <div class="or">OR</div>
            
        </div>
        
        
        <div class="footer">
            <h3>Contact us: <a href="mailto:info@letsparty.staff.com">info@letsparty.staff.com</a></h3>
        </div>
                   
    </body>
</html>
