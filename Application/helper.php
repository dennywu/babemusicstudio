<?php
    function convertCurr($amount){
       return "Rp ".number_format($amount, 2, ",", ".");
    }
    
    function formatDate($date){
        $tgl = split("-",$date);
        return $tgl[2]." ".getMonth($tgl[1])." ".$tgl[0];
    }
    function getMonth($m){
        $m = intval($m);
        $bulan = array("January","Febuari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        return $bulan[$m];
    }
?>
