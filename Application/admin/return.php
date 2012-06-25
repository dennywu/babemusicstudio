<?php
    require_once('../mysql.class.php');
    require_once('../global.inc.php');
    
    $id = $_POST['rentalid'];
    //$rentalDetail = mysql_query("select * from rentaldetail where rentalid = '$id'");
    $query = "SELECT d.id, d.total,d.term, d.qty, case when (((DATEDIFF(now(), d.returndate) * d.qty) * d.term) * b.dendaperhari)  is null then 0 when (DATEDIFF(now(), d.returndate) * qty * b.dendaperhari) < 0 then 0 else (((DATEDIFF(now(), d.returndate) * d.qty) * d.term) * b.dendaperhari) end as denda
                from rental r inner join rentaldetail d on (r.id = d.rentalid) inner join paket b on (d.paketid = b.id) 
                where r.id = '$id'";
    $result = mysql_query($query);
    $totaldenda = 0;
    while($d = mysql_fetch_array($result)){
        $totaldenda += $d['denda'];
        $totalperitem = $d['total'] + $d['denda'];
        $resultUpdate = mysql_query("UPDATE rentaldetail set denda = '$d[denda]', total = '$totalperitem' where id = '$d[id]'");
    }
    $queryRental = mysql_query("SELECT total,outstanding from rental where id = '$id'");
    if($r = mysql_fetch_array($queryRental)){
        $total = $r['total'] + $totaldenda;
        $telahdibayar = $r['total'] - $r['outstanding'];
        $outstanding = $total - $telahdibayar;
        if($outstanding == 0){
            mysql_query("UPDATE rental set total = '$total', outstanding = '$outstanding',isreturn ='true' where id = '$id'");
        }
        else{
            mysql_query("UPDATE rental set total = '$total', outstanding = '$outstanding',isreturn ='true',status='Bayar' where id = '$id'");
        }
    }
    
    mysql_query("Update rental set status = 'Kembali' where id = '$id'");
    echo header("location:/rent-band/views/admin/home.php");
?>
