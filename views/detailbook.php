<?php
    function showDetailPaket($book){
            $html[] = "<li>
            <a href='/rent-band/images/books/".$book[image]."' target='_blank'>
            <img src='/rent-band/images/books/".$book[image]."' style='width:270px;'>
            </a>
            <div class='w320 left'>
            <span class='c_blue_kompas font16'><strong>".$book['name']."</strong></span><br>
            </div>
            <div class='right w150'>
            <span class='font14'><b>".convertCurr($book['amount'])."/ Hari</b></span>
            <br><br>

            <span class='beli'><a href='/rent-band/Application/cart.php?action=add&id=".$book['id']."'></a></span>
            </div>
            <div class='clearit pt_5'></div>
            </li>
            <div style='margin-left:10px;font-size:14px;font-weight:bold;'>Detil Paket:</div>
            <div style='margin-left:10px;text-align: justify;padding-right:50px;'>".$book[detail]."</div>
            ";
        return join('',$html);
    }
?>
