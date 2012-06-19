<?php
    require_once('../mysql.class.php');
    require_once('../global.inc.php');
    
    $id = $_GET['id'];
    $qry = "SELECT r.id,r.norental,r.status,r.outstanding, r.rentaldate, r.expiredate,r.total, c.title, c.name, 
            c.address from rental r inner join customer c on (r.custid = c.id) 
            where r.id = '$id'";
    $result = mysql_query($qry);
    $rental;
    while($row = mysql_fetch_array($result)){
        $rental= $row;
    }
    
    $qrydetail = "SELECT d.denda, r.total, r.outstanding,d.qty, d.term, d.total, b.name, b.image, b.amount as hargasatuan  
                  from rental r inner join rentaldetail d on (r.id = d.rentalid) inner join paket b on (d.paketid = b.id) 
                  where r.id = '$id'";
    $resultDetail = mysql_query($qrydetail);
    $rental['items'] = array();
    while($row = mysql_fetch_array($resultDetail)){
        array_push($rental['items'], $row);
    }
    echo json_encode($rental);
?>
