
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="/rent-band/css/site.css" rel="stylesheet" type="css/text"/>
        <link href="/rent-band/css/books.css" rel="stylesheet" type="css/text"/>
        <link href="/rent-band/css/bootstrap.css" rel="stylesheet" type="css/text"/>
        <script src="/rent-band/javascript/plugin/jquery.min.js"></script>
        <script src="/rent-band/javascript/plugin/CurrencyRounding.js"></script>
        <script src="/rent-band/javascript/plugin/DateFormat.js"></script>
        <title></title>
    </head>
    <body>
        <?php include_once 'views/navigation.php'; ?>
        <?php
             require_once('Application/mysql.class.php');
             require_once('Application/global.inc.php');
             require_once('Application/helper.php');
             require_once('Application/repository/BookRepository.php');
             require_once('views/detailbook.php');
        ?>
        <div class="container-page">
            <table cellspacing="0" cellpadding="0" width="100%;">
                <tbody>
                    <tr>
                        <td width="625px" colspan="3">
                            <ul id="list-books">
                                <?php 
                                    $paket = getPaketById($_GET[id]);
                                    echo showDetailPaket($paket);
                                ?>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
	<?php include_once 'views/footer.php'; ?>
    </body>
</html>
