<!DOCTYPE HTML>
<head>
    <meta charset="utf-8">
    <title>Let's Party!</title>
</head>

<?php

/////////////////////////////////////////////////AUX FUNCT//////////////////////////////////////////////
    function gettype_fromstring($string){
        //  (c) José Moreira - Microdual (www.microdual.com)
        return gettype(getcorrectvariable($string));
    }
    function getcorrectvariable($string){
        //  (c) José Moreira - Microdual (www.microdual.com)
        //      With the help of Svisstack (http://stackoverflow.com/users/283564/svisstack)
        
        /* FUNCTION FLOW */
        // *1. Remove unused spaces
        // *2. Check if it is empty, if yes, return blank string
        // *3. Check if it is numeric
        // *4. If numeric, this may be a integer or double, must compare this values.
        // *5. If string, try parse to bool.
        // *6. If not, this is string.
        
        $string=trim($string);
        if(empty($string)) return "";
        if(!preg_match("/[^0-9.]+/",$string)){
            if(preg_match("/[.]+/",$string)){
                return (double)$string;
            }else{
                return (int)$string;
            }
        }
        if($string=="true") return true;
        if($string=="false") return false;
        return (string)$string;
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////

    session_start();
    require_once('../db/mysql_credentials.php');
    
    // Open DBMS Server connection
    $con = new mysqli($mysql_host,$mysql_user,$mysql_pass,$mysql_db, $mysql_port);
    if(mysqli_connect_errno($con)){
        echo "Failed to connect to MySql: " . mysqli_connect_error($con);   //DEBUG
    }
    
    $name=mysqli_real_escape_string($con,trim($_POST['username']));
    $number=mysqli_real_escape_string($con,trim($_POST['cardNumber']));
    $month=mysqli_real_escape_string($con,trim($_POST['month']));
    $year=mysqli_real_escape_string($con,trim($_POST['year']));
    $cvv=mysqli_real_escape_string($con,trim($_POST['cvv']));
    $amount=mysqli_real_escape_string($con,trim($_POST['amount']));
    
    if(("double"==gettype_fromstring($amount)) && ("string"==gettype_fromstring($name)) && ("integer"==gettype_fromstring($number)) && ("integer"==gettype_fromstring($month)) &&  ("integer"==gettype_fromstring($year)) && ("integer"==gettype_fromstring($cvv))){
    
        $query = "INSERT INTO Transactions(name,number,month,year,cvv,amount) VALUES ('".$name."','".$number."','".$month."','".$year."','".$cvv."','".$amount."')";
        $res = $con->query($query);
        
        if($res){
            header("Location: ../html/Thank_you.php");
        } else echo "Error while registering your transaction!";
        
        mysqli_free_result($res);
        mysqli_close($con);
        
    } else { echo "Wrong input types!";
             mysqli_free_result($res);
             mysqli_close($con);
           }
    
?>