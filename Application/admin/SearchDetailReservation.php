<?php
    require_once('../mysql.class.php');
    require_once('../global.inc.php');
    
    $dari = $_POST["dari"];
    $sampai = $_POST['sampai'];
    
    $qry = "select norental,
            (select name from customer where id = rental.custid) as customer,
            rentaldate,outstanding,sum(total) as total 
            from rental where status != 'Booking' and 
                 rentaldate between '$dari' and '$sampai' 
            group by norental";
    $result = mysql_query($qry);
    $reservations = array();
    while($row = mysql_fetch_array($result)){
        array_push($reservations, $row);
    }
    
    echo json_encode($reservations);
?>
