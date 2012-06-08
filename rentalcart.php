<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="/rent-band/css/site.css" rel="stylesheet" type="css/text"/>
        <link href="/rent-band/css/rentalCart.css" rel="stylesheet" type="css/text"/>
        <link href="/rent-band/css/rentalCartPrint.css" rel="stylesheet" media="print" type="css/text"/>
        
        <script src="/rent-band/javascript/plugin/jquery.min.js"></script>
        <script src="/rent-band/javascript/plugin/PrintDocument.js"></script>
        <script src="/rent-band/javascript/plugin/DateFormat.js"></script>
        <script src="/rent-band/javascript/rentalCart.js"></script>
        <title></title>
    </head>
    <body>
        <?php include_once 'views/navigation.php'; ?>
        <div class="container-page">
            <table cellspacing="0" class="tblRentalCart">
                <thead>
                    <tr class="tr2">
                        <th class="text-left" colspan="2">Paket</th>
                        <th width="130px" class="text-right">Harga Sewa/ Hari</th>
                        <th width="60px" class="text-right">Qty</th>
                        <th width="80px" class="text-right">Lama Sewa</th>
                        <th width="130px" class="text-right">Total</th>
                        <th width="20px" class="hide"></th>
                        <th width="10px" class="hide"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        require_once('Application/functions.inc.php');
                        require_once('Application/helper.php');
                        echo showCart();
                    ?>
                </tbody>
            </table>
            <div id="inputcust"></div>
        </div>
        <?php include_once 'views/footer.php'; ?>
    </body>
</html>
