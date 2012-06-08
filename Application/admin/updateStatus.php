<?php
    require_once('../mysql.class.php');
    require_once('../global.inc.php');
    
    $id = $_POST['id'];
    $status = $_POST['status'];
    $rental = mysql_query("select status from rental where id = '$id'");
    if($r = mysql_fetch_array($rental)){
        $statusRental = $r[status];
    }
    
    switch($statusRental){
        case "Booking": 
                    if($status == "Kembali"){
                        break;
                    }
                    if($status == 'Bayar'){
                        updateReturnDate();
                    }
                    else if($status == 'Cancel'){
                        kembali();
                    }
                    mysql_query("Update rental set status = '$status' where id = '$id'");
                    break;
        case "Bayar":
                    if($status == "Booking"){
                    }
                    else if($status == "Cancel"){
                        break;
                    }
                    else if($status == "Kembali"){
                        kembali();
                    }
                    mysql_query("Update rental set status = '$status' where id = '$id'");
                    break;
        case 'Kembali':
                    if($status == "Booking" || $status == "Cancel"){
                        break;
                    }
                    if($status == "Bayar"){
                        pinjam();
                        updateReturnDate();
                    }
                    mysql_query("Update rental set status = '$status' where id = '$id'");
                    break;
        case 'Cancel':
                    if($status == "Kembali" || $status == "Booking"){
                        break;
                    }
                    else if($status == "Bayar"){
                        pinjam();
                        updateReturnDate();
                    }
                    mysql_query("Update rental set status = '$status' where id = '$id'");
                    break;
    }
    
    function pinjam(){
        $id = $_POST['id'];
        $items = mysql_query("select * from rentaldetail where rentalid = '$id'");
        while($row = mysql_fetch_array($items)){
            $books = mysql_query("Select stock from book where id = '$row[bookid]'");
            if($book = mysql_fetch_array($books)){
                $stock = $book[stock] - $row[qty];
                mysql_query("Update book set stock = '$stock' where id = '$row[bookid]'");
            }
        }
    }
    function updateReturnDate(){
        $id = $_POST['id'];
        $items = mysql_query("select * from rentaldetail where rentalid = '$id'");
        while($row = mysql_fetch_array($items)){
                $date = date("Y-m-d");
                $returndate = date("Y-m-d",strtotime(date("Y-m-d", strtotime($date)) . " +".$row[term]." day"));
                mysql_query("Update rentaldetail set returndate = '$returndate' where id = '$row[id]'");
        }
    }
    function kembali(){
        $id = $_POST['id'];
        $items = mysql_query("select * from rentaldetail where rentalid = '$id'");
        while($row = mysql_fetch_array($items)){
            $books = mysql_query("Select stock from book where id = '$row[bookid]'");
            if($book = mysql_fetch_array($books)){
                $stock = $row[qty] + $book[stock];
                mysql_query("Update book set stock = '$stock' where id = '$row[bookid]'");
            }
        }
    }    
    
    $error = array();
    array_push($error, "false");
    echo json_encode($error);
?>
