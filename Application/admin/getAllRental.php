<?php
    require_once('../mysql.class.php');
    require_once('../global.inc.php');
    
    $qry = "SELECT *, (select name from customer where id = rental.custid) as pelanggan FROM `rental`";
    $result = mysql_query($qry);
    $rentals = array();
    while($row = mysql_fetch_array($result)){
        array_push($rentals, $row);
    }
    echo json_encode($rentals);
?>
