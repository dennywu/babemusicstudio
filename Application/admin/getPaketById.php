<?php
    require_once('../mysql.class.php');
    require_once('../global.inc.php');
    
    $id = $_GET["id"];
    $qry = "SELECT * FROM paket where id = '$id'";
    $result = mysql_query($qry);
    $book;
    while($row = mysql_fetch_array($result)){
        $book = $row;
    }
    echo json_encode($book);
?>
