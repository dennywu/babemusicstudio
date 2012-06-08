<?php
    require_once('../mysql.class.php');
    require_once('../global.inc.php');
    
    $qry = "SELECT * FROM paket";
    $result = mysql_query($qry);
    $book = array();
    while($row = mysql_fetch_array($result)){
        array_push($book, $row);
    }
    echo json_encode($book);
?>
