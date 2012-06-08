<?php
    require_once('../mysql.class.php');
    require_once('../global.inc.php');
    
    $qry = "SELECT * FROM kategori";
    $result = mysql_query($qry);
    $categories = array();
    while($row = mysql_fetch_array($result)){
        array_push($categories, $row);
    }
    echo json_encode($categories);
?>
