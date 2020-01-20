<?php
    include '../php/getSession.php';
    // Get profile data from database (check current session)
    if(!isset($sessionID)){
      echo"<script>window.location.href = '../html/LoginAndRegistration.php';</script>";
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
      
      <form id="search" action="../php/search.php">
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
          <a href="#" class="button">Checkout</a>
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

      <script>
        function Logout(){
          window.location.href = '../php/logout.php';
        }

        function Update(){
          window.location.href = '../html/UpdateProfile.php';
        }
      </script>
        <h1>
            Profile
        </h1>
        <div id="user-box">
            <div class="left">
            Email: <?php echo $user["email"] ?><br>
            First name: <?php echo $user["firstName"] ?><br>
            Last name: <?php echo $user["lastName"] ?><br>
            City: <?php echo $user["city"] ?><br>
            About me: <?php echo $user["about_me"] ?><br><br>
            
            <input type="submit" value="Logout" onclick="Logout()">
            <input type="submit" value="Update" onclick="Update()">
            </div>
        </div>
        <div class="footer">
            <h3>Contact us: <a href="mailto:info@letsparty.staff.com">info@letsparty.staff.com</a></h3>
        </div>       
    </body>
</html>
