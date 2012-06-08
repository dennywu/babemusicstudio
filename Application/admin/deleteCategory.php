<?php
    require_once('../mysql.class.php');
    require_once('../global.inc.php');
    
    $id = $_GET['id'];
    $result = mysql_query("Select count(*) as total from book where kategori = '$id'");
    if($result){
        if($row = mysql_fetch_array($result)){
            if($row[total] == 0){
                $qry = "delete from kategori where id = '$id'";
                $result = mysql_query($qry);
                header("Location:/rent-band/views/admin/category.php");
            }
            else
            {
                header("Location:/rent-band/views/admin/category.php?error='Ada buku yang menggunakan kategori ini'");
            }
        }
    }
    
?>
