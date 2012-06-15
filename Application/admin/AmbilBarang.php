<?php
    require_once('../mysql.class.php');
    require_once('../global.inc.php');
    
    $id = $_POST['rentalid'];
    $rental = mysql_query("select * from rental where id = '$id'");
    
    
    if($r = mysql_fetch_array($rental)){
        $rentalDetail = mysql_query("select * from rentaldetail where rentalid = '$id'");
        while($rd = mysql_fetch_array($rentalDetail)){
            $date = date("Y-m-d");
            $returndate = date("Y-m-d",strtotime(date("Y-m-d", strtotime($date)) . " +".$rd[term]." day"));
            mysql_query("Update rentaldetail set returndate = '$returndate' where id = '$rd[id]'");
        }
        $queryRental = mysql_query("SELECT total,outstanding from rental where id = '$id'");
        if($r = mysql_fetch_array($queryRental)){
            $outstanding = $r[total];
            mysql_query("UPDATE rental set outstanding = '$outstanding',status= 'Pinjam' where id = '$id'");
        }
    }
    echo header("location:/rent-band/views/admin/home.php");
?>
