<!DOCTYPE HTML>
<head>
    <meta charset="utf-8">
    <title>Let's Party!</title>
</head>

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
          $user=mysqli_fetch_assoc($res);
          mysqli_free_result($res);
      }
      else{
          echo("Unexpected error <br>");
      }                 
      mysqli_close($con);
    }
?>