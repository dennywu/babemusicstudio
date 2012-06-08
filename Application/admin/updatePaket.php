<?php
    require_once('../mysql.class.php');
    require_once('../global.inc.php');
    
    $data = $_POST;
    $filename = $_FILES['image']['name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    if($fileSize > 0 || $fileError == 0){ //check if the file is corrupt or error
        $move = move_uploaded_file($_FILES['image']['tmp_name'], '../../images/books/'.$filename); //save image to the folder
    }

    if($filename){
            $qry = "Update paket set name = '$data[name]',detail = '$data[detail]', amount = '$data[amount]', image= '$filename'
                    where id = '$data[id]'";
        }
    else{
            $qry = "Update paket set name = '$data[name]', detail = '$data[detail]', amount = '$data[amount]'
                    where id = '$data[id]'";
        }
    
    $result = mysql_query($qry);
    header("location:/rent-band/views/admin/paket.php");
?>
