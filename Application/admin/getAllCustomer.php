<?php
    require_once('../mysql.class.php');
    require_once('../global.inc.php');
    
    $qry = "SELECT * FROM customer";
    $result = mysql_query($qry);
    $customers = array();
    while($row = mysql_fetch_array($result)){
        array_push($customers, $row);
    }
    echo json_encode($customers);
?>
