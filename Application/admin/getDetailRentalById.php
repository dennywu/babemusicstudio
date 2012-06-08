<?php
    require_once('../mysql.class.php');
    require_once('../global.inc.php');
    
    $id = $_GET['id'];
    $qry = "SELECT r.id,r.norental,r.status, r.rentaldate, r.expiredate,r.total, c.title, c.name, 
            c.address from rental r inner join customer c on (r.custid = c.id) 
            where r.id = '$id'";
    $result = mysql_query($qry);
    $rental;
    while($row = mysql_fetch_array($result)){
        $rental= $row;
    }
    
    $qrydetail = "SELECT case when (DATEDIFF(now(), d.returndate) * qty * 2000)  is null then 0 when (DATEDIFF(now(), d.returndate) * qty * 2000) < 0 then 0 else (DATEDIFF(now(), d.returndate) * qty * 2000) end as denda,
				r.total,d.qty, d.term, d.total, b.name,b.author, b.publisher, b.published, b.image, b.amount as hargasatuan  
                  from rental r inner join rentaldetail d on (r.id = d.rentalid) inner join book b on (d.bookid = b.id) 
                  where r.id = '$id'";
    $resultDetail = mysql_query($qrydetail);
    $rental['items'] = array();
    while($row = mysql_fetch_array($resultDetail)){
        array_push($rental['items'], $row);
    }
    echo json_encode($rental);
?>
