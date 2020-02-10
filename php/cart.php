<script>

function showCart(a){
    var cart = document.getElementById("nav-right");
    var profile = document.getElementById("profile");
    var login = document.getElementById("login");
    if(a){
        profile.style.display="block";
        login.style.display="none";
        cart.style.display="block";
        var badge=0;
        var total=0;
        var badgeSpan = document.getElementById("num");
        var badgeSpan2 = document.getElementById("num2");
        var totalSpan = document.getElementById("total");
        <?php
        if(isset($_SESSION["cart"])){
            ?>
            var cartArray= <?php echo json_encode($_SESSION["cart"], JSON_PRETTY_PRINT);?>;
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
      if(isset($user)) 
      { 
        ?>     
        <script>
          showCart(true);
          </script>
        <?php
      }
      else
      {
        ?>
        <script>
        showCart(false);
        </script>
        <?php
      }
    ?>

