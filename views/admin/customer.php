<html>
    <head>
        <link href="/rent-band/css/site.css" rel="stylesheet" type="css/text"/>
        <link href="/rent-band/css/admin/customer.css" rel="stylesheet" type="css/text"/>
        <script src="/rent-band/javascript/plugin/jquery.min.js"></script>
        <script src="/rent-band/javascript/admin/customer.js"></script>
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
                            <table id="tblCustomer" cellpadding="0" cellspacing="0" border="0" width="80%">
                                <thead>
                                    <tr>
                                        <td>Nama</td>
                                        <td>Alamat</td>
                                        <td>Kota</td>
                                        <td>Negara</td>
                                        <td>No. Telp</td>
                                        <td>Email</td>
                                    </tr>
                                <thead>
                                <tbody>
                                </tbody>
                            </table>
            </div>
        <?php
            }
        ?>
    </body>
</html>