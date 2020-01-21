<?php
  include '../php/getSession.php';
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
    

    <h1>Your Cart:</h1>       
    <div class="main">   
        <div id="cart-list">    
        </div>              
    </div>
    
    <br><br>

    <div class="footer">
        <h3>Contact us: <a href="mailto:info@letsparty.staff.com">info@letsparty.staff.com</a></h3>
    </div>

          
        <script>
            var total=0;
            var cartArray= <?php
              if(isset($_SESSION["cart"])){
                echo json_encode($_SESSION["cart"], JSON_PRETTY_PRINT);
              }
              else{
                echo 0;
              } 
            ?>;                
            if(cartArray!=null){
              Object.keys(cartArray).forEach(function (key){
                var temp = document.createElement("div");
                temp.className = "item";
                var name = document.createElement("div");
                name.className="item-name";
                name.innerHTML = "Event: " + cartArray[key].name;
                var price = document.createElement("div");
                price.className="item-price";
                if(cartArray[key].price == null)
                    var pr="Free";
                else
                    var pr=cartArray[key].price + "€";
                price.innerHTML = "Price: " + pr;
                var quantity = document.createElement("div");
                quantity.className="item-quantity";
                quantity.innerHTML = "Quantity: " + cartArray[key].quantity;
                var button = document.createElement("input");
                button.type = "submit";
                button.value = "Remove";
                button.onclick = function(){
                  window.location.href= "../php/removeFromCart.php?ID="+key;
                }
                temp.appendChild(name);
                temp.appendChild(price);
                temp.appendChild(quantity);
                temp.appendChild(button);
                document.getElementById("cart-list").appendChild(temp);
                    
                total+=cartArray[key].price*cartArray[key].quantity;
              });
            }
            var elem = document.createElement("div");
            elem.className="Item";
            var tot = document.createElement("div");
            tot.className="total";
            tot.innerHTML = "Total price: " + total + "€";
            var buy = document.createElement("input");
            buy.type="submit";
            buy.value="Buy";
            buy.onclick= function(){
              window.location.href="../php/buy.php?cart="+JSON.stringify(cartArray);
            }
            elem.appendChild(tot);
            elem.appendChild(buy);
            document.getElementById("cart-list").appendChild(elem);
      </script>  
  </body>
</html>
