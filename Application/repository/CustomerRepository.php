<?php
    function GetCustomerById($id){
        $qry = "Select * from customer where id = '$id'";
        $result = mysql_query($qry);
        $customer;
        while($row = mysql_fetch_array($result)){
            $customer = $row;
        }
        return $customer;
    }
?>
