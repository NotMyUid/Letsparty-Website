<?php
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
          $user=mysqli_fetch_assoc($res);?>
          <script>
          if(document.referrer.includes("Login")){
            document.addEventListener('DOMContentLoaded', function() {
                alert("Welcome <?php echo $user['firstName']; ?>");
            }, false);
          }
          </script><?php
          mysqli_free_result($res);
      }
      else{
          echo("Unexpected error <br>");
      }                 
      mysqli_close($con);
    }
?>