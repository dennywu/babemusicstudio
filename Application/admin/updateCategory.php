<?php
    require_once('../mysql.class.php');
    require_once('../global.inc.php');
    
    $id = $_POST['categoryid'];
    $name = $_POST['categoryName'];
    $qry = "Update kategori set name = '$name' where id = '$id'";
    $result = mysql_query($qry);
    header("Location:/rent-band/views/admin/category.php");
?>
