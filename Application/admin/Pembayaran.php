<?php
    require_once('../mysql.class.php');
    require_once('../global.inc.php');
    
    $id = $_POST['rentalid'];
    $amount = $_POST['amount'];
    $rental = mysql_query("select status,outstanding from rental where id = '$id'");
    
    
    if($r = mysql_fetch_array($rental)){
        //$statusRental = $r[status];
        $outstanding = $r[outstanding];
        $totaloutstanding = $outstanding - $amount;
        if($totaloutstanding == 0){
            mysql_query("Update rental set status = 'Lunas',outstanding = '$totaloutstanding' where id = '$id'");
        }
        else{
            mysql_query("Update rental set status = 'Bayar',outstanding = '$totaloutstanding' where id = '$id'");
        }
        mysql_query("INSERT INTO payment (rentalid,paymentdate,amount) values('$id',NOW(),'$amount')");
    }
    echo header("location:/rent-band/views/admin/home.php");
?>
