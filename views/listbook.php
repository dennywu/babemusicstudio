<?php
    function showPaket($books){
        for($i=0;$i < count($books); $i++){
            $html[] = "<li>
            <a href='/rent-band/images/books/".$books[$i][image]."' target='_blank'>
            <img src='/rent-band/images/books/".$books[$i][image]."'>
            </a>
            <div class='w320 left'>
            <span class='c_blue_kompas font16'><strong><a href='/rent-band/detailpaket.php?id=".$books[$i][id]."'>".$books[$i]['name']."</a></strong></span><br>
            <span class='font11 c_abu font11'>klik untuk lihat detail</span><br><br>
            <span class='font11 c_abu font12'></span><br>
            </div>
            <div class='right w150'>
            <span class='font14'><b>".convertCurr($books[$i]['amount'])."/ Hari</b></span>
            <br><br>

            <span class='beli'><a href='/rent-band/Application/cart.php?action=add&id=".$books[$i]['id']."'></a></span>
            </div>
            <div class='clearit pt_5'></div>
            </li>";
        }
        return join('',$html);
    }
    function showPagging($currPage){
        $total = countPaket();
        $totalPage = ceil($total / 10);
        $html[] = "<div class='pagination'><ul>";
            $url = "/rent-band/books.php?";
        if($currPage > 1){
            $html[] = "<li><a href='".$url."cp=".($currPage-1)."'>Prev</a></li>";
        }      
        for($i = 1; $i <= $totalPage; $i++){
            if($i == $currPage){
               $html[] = "<li class='active'><a>".$i."</a></li>";
            }
            else
            {
                $html[] = "<li><a href='".$url."cp=".$i."'>".$i."</a></li>";
            }
        }
        
        if($currPage < $totalPage){
            $html[] = "<li><a href='".$url."cp=".($currPage+1)."'>Next</a></li>";
        }
        $html[] = "</ul></div>";
        return join("",$html);
    }
?>
