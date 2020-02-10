<!DOCTYPE HTML>
<head>
    <meta charset="utf-8">
    <title>Let's Party!</title>
</head>

<?php
    session_start();
    // TODO: change credentials in the db/mysql_credentials.php file
    require_once('../db/mysql_credentials.php');
    // Open DBMS Server connection
    $con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db,$mysql_port);
    // Get value from $_SESSION
    $ID=$_SESSION["ID"];
    $query="SELECT * FROM Users WHERE ID ='".$ID."'";
    $res = $con->query($query);
    if($res)
    {
        $row=mysqli_fetch_assoc($res);
    }
    mysqli_free_result($res);
    $email = $row["email"];
    $name = $row["firstName"];
    mysqli_close($con);
    
    require '../newsletter/PHPMailerAutoload.php';
    
    if (isset($_POST["sub"])){
        
        $con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db,$mysql_port);
        $query="INSERT INTO Mailist(email,name) VALUES ('".$email."','".$name."')";
        $res = $con->query($query);
        if($res){
        
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Mailer = "smtp";
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            
            $mail->SMTPAuth = true;
            $mail->Username = $gmail_user;
            $mail->Password = $gmail_pass;
            $mail->setFrom($gmail_user, 'Letsparty');
            
            $mail->addAddress($email, $name);     // Add a recipient
            
            $mail->isHTML(true);                  // Set email format to HTML
            
            $mail->Subject = 'Partyletter!';
            $mail->Body    = 'Welcome to let\'s party\'s <b>newsletter!</b>';
            $mail->AltBody = 'Welcome to let\'s party\'s newsletter!';
            
            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                header("Location: ../html/show_profile.php");
            }
            
        } else echo "User already registered!";
        
        mysqli_free_result($res);
        mysqli_close($con);
        
    } else if (isset($_POST["unsub"])){
        $con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db,$mysql_port);
        $query = "DELETE FROM Mailist WHERE email='".$email."'";
        $res = $con->query($query);
        if($res) header("Location: ../html/show_profile.php");
        else echo "Error in deleting your subscription! :(";
        
        mysqli_free_result($res);
        mysqli_close($con);
    }
    