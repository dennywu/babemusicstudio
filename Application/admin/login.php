<?php
    require_once('../mysql.class.php');
    require_once('../global.inc.php');
    
    
    $username = $_POST["username"];
    $pass = $_POST["password"];
    $qry = "SELECT * FROM user where username = '$username' and password = '$pass'";
    $result = mysql_query($qry);
        if($row = mysql_fetch_array($result)){
            session_start();
            $_SESSION["admin"] = $row["username"];
            header("Location:/rent-band/views/admin/home.php");
        }
        else{
            header("Location:/rent-band/login.php");
        }
?>
