<?php
    function showCategory($data){
        $html[] ='<tr><td><div class="headerCategory">Kategori</div></td></tr>';
        for($i=0;$i < count($data); $i++){
            $color = $i %2 == 1 ? "#f2f3f3":"#f8f8f8";
            $html[] = "<tr><td><div class='list-category' style='background-color:".$color."'>
                <a href='/rent-band/books.php?p=".$data[$i]['id']."'>".$data[$i]['name']."</a>
                </div>
                </td></tr>";
        }
        return join('',$html);
    }
?>
