<?php
    session_start();
    require_once('mysql.class.php');
    require_once('global.inc.php');
    require_once('functions.inc.php');
    require_once('repository/CustomerRepository.php');
    global $db;
    $custid = insertCustomer();
    $total = total();
    $norental = uniqid();
    $rentalid = uniqid();
    
    createRental($db,$custid, $total, $norental, $rentalid);
    
    $now = new DateTime;
    $now->setTimezone(new DateTimeZone( "Asia/Jakarta" ));
    
    
    $expiredate = new Datetime;
    $expiredate->setTimezone(new DateTimeZone( "Asia/Jakarta" ));
    $expiredate->add(new DateInterval('P1D'));
    
    
    $data = GetCustomerById($custid);
    $data[norental] = $norental;
    $data[rentaldate] = $now;
    $data[expiredate] = $expiredate;
    echo json_encode($data);
    
    function createRental($db,$custid, $total, $norental, $rentalid){
        $qry = "INSERT INTO rental (id, norental, custid, rentaldate,expiredate, total, status)
                values ('$rentalid','$norental','$custid',NOW(),DATE_ADD(NOW(), INTERVAL 24 HOUR),'$total','Booking')";
        $result = mysql_query($qry);
        if($result){
            createRentalDetail($rentalid, $db);
            //negateStock($rentalid);
            unset($_SESSION['cart']); 
        }
    }
    
    function createRentalDetail($rentalid, $db){
        $items = $_SESSION['cart'];
        foreach ($items as $item) {
            $sql = 'SELECT * FROM paket WHERE id = '.$item["id"];
            $result = $db->query($sql);
            $row = $result->fetch();
            extract($row);
            $total = ($amount * $item["qty"] * $item["hari"]);
            $qry = "INSERT INTO rentaldetail (rentalid,paketid, qty, term, total)
                    values ('$rentalid','$item[id]','$item[qty]','$item[hari]', '$total')";
            mysql_query($qry);
        }
    }
    function negateStock($rentalid){
        $items = mysql_query("select * from rentaldetail where rentalid = '$rentalid'");
        while($row = mysql_fetch_array($items)){
            $books = mysql_query("Select stock from book where id = '$row[bookid]'");
            if($book = mysql_fetch_array($books)){
                $stock = $book[stock] - $row[qty];
                mysql_query("Update book set stock = '$stock' where id = '$row[bookid]'");
            }
        }
    }
    
    function insertCustomer(){
        $name = $_POST["name"];
        $title = $_POST["title"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $telp = $_POST["telp"];
        $email = $_POST["email"];
        $id = uniqid();
        
        $qrycust = "INSERT INTO customer (id, title, name, address, city, state,telp, email) 
                    values ('$id' ,'$title', '$name', '$address', '$city', '$state', '$telp', '$email')";
        $result = mysql_query($qrycust);
        if($result)
            return $id;
        return null;
    }
    function total(){
        global $db;
        $items = $_SESSION['cart'];
        $total = 0;
        foreach ($items as $item) {
            $sql = 'SELECT * FROM paket WHERE id = '.$item["id"];
            $result = $db->query($sql);
            $row = $result->fetch();
            extract($row);
            $total += ($amount * $item["qty"] * $item["hari"]);           
        }
        return $total;
    }
?>
