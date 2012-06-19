<html>
    <head>
        <link href="/rent-band/css/site.css" rel="stylesheet" type="css/text"/>
        <link href="/rent-band/css/admin/book.css" rel="stylesheet" type="css/text"/>
        <link href="/rent-band/css/ModalDialog.css" rel="stylesheet" type="css/text"/>
        <script src="/rent-band/javascript/plugin/jquery.min.js"></script>
        <script src="/rent-band/javascript/plugin/DateFormat.js"></script>
        <script src="/rent-band/javascript/plugin/PrintDocument.js"></script>
        <script src="/rent-band/javascript/plugin/CurrencyRounding.js"></script>
        <script src="/rent-band/javascript/plugin/ModalDialog.js"></script>
        <script src="/rent-band/javascript/admin/book.js"></script>
    </head>
    <body>
        <?php 
            session_start();
            if($_SESSION["admin"] == null || $_SESSION["admin"] == "")
            {
                header("Location:/rent-band/login.php");
            }else{
                include_once "navigation.php";
            
        ?>
        <div class="container-page">
            <table cellpadding="0" cellspacing="0" width="100%" id="tblbook">
                <thead>
                    <tr>
                        <td width="50px;"></td>
                        <td>Nama Paket</td>
                        <td class='text-right'>Denda Per Hari</td>
                        <td class='text-right'>Harga Sewa Per Hari</td>
                        <td width='45px'></td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
			<div width='100%' style="margin-top:5px;text-align:center;"><input type='button' onclick="createBook()" value='Tambah Buku Baru' /></div>
        </div>
        <?php
            }
        ?>
    </body>
</html>
