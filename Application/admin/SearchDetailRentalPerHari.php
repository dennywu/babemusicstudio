<?php
    require_once('../mysql.class.php');
    require_once('../global.inc.php');
    
    $dari = $_POST["dari"];
    $sampai = $_POST['sampai'];
    
    $qry = "select CAST(rentaldate AS DATE)as rentaldate,sum(total) as total , sum(outstanding) as outstanding
            from rental where 
                 rentaldate between '$dari' and '$sampai'  And status != 'Booking'
            group by CAST(rentaldate AS DATE)";
    $result = mysql_query($qry);
    $reservations = array();
    while($row = mysql_fetch_array($result)){
        array_push($reservations, $row);
    }
    
    echo json_encode($reservations);
?>
