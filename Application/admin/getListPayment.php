<?php
    require_once('../mysql.class.php');
    require_once('../global.inc.php');
    
    $id = $_GET["id"];
    $qry = "SELECT * FROM payment where rentalid = '$id'";
    $result = mysql_query($qry);
    $payment = array();
    while($row = mysql_fetch_array($result)){
        array_push($payment, $row);
    }
    echo json_encode($payment);
?>
