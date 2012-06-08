<?php
    function getPakets($offset){
        $qry = "Select * from paket limit 10 offset $offset";
        $result = mysql_query($qry);
        $paket = array();
        while($row = mysql_fetch_array($result)){
            array_push($paket, $row);
        }
        return $paket;
    }
    function getPaketById($id){
        $qry = "SELECT * FROM paket where id = '$id'";
        $result = mysql_query($qry);
        $paket;
        while($row = mysql_fetch_array($result)){
            $paket = $row;
        }
        return $paket;
    }
    function getBookByCategory($category,$offset){
        $qry = "Select * from book where kategori = '$category' and stock > 0 limit 10 offset $offset";
        $result = mysql_query($qry);
        $books = array();
        while($row = mysql_fetch_array($result)){
            array_push($books, $row);
        }
        return $books;
    }
    function countPaket(){
        if($category == ''){
            $qry = "select count(*) as total from paket";
        }
        else{
            $qry = "select count(*) as total from book where stock > 0 and kategori = '$category'";
        }
        $result = mysql_query($qry);
        $total;
        while($row = mysql_fetch_array($result)){
            $total = $row[total];
        }
        return $total;
    }
    function getCategory(){
        $qry = "Select * from kategori";
        $result = mysql_query($qry);
        $kategori = array();
        while($row = mysql_fetch_array($result)){
            array_push($kategori, $row);
        }
        return $kategori;
    }
?>
