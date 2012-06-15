
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="/rent-band/css/site.css" rel="stylesheet"/>
        <link href="/rent-band/css/books.css" rel="stylesheet"/>
        <link href="/rent-band/css/bootstrap.css" rel="stylesheet"/>
        <script src="/rent-band/javascript/plugin/jquery.min.js"></script>
        <script src="/rent-band/javascript/plugin/CurrencyRounding.js"></script>
        <script src="/rent-band/javascript/plugin/DateFormat.js"></script>
        <!--<script src="/rent-band/javascript/book.js"></script>-->
        <title></title>
    </head>
    <body>
        <?php include_once 'views/navigation.php'; ?>
        <?php
             require_once('Application/mysql.class.php');
             require_once('Application/global.inc.php');
             require_once('Application/helper.php');
             require_once('Application/repository/BookRepository.php');
             require_once('views/listbook.php');
             require_once('views/listcategory.php');
             if($_GET["cp"] == null){
                 $currPage = 1;
             }
             else{
                 $currPage = $_GET["cp"];
             }
             
             $paket = getPakets($currPage - 1);
             
        ?>
        <div class="container-page">
            <table cellspacing="0" cellpadding="0" width="100%;">
                <thead>
                    <tr>
                        <th style="text-align:right;width:625px;" colspan="3">
                            <div>
                                <?php
                                    echo showPagging($currPage);
                                ?>
                            </div>
                        </th>
                        <th valign="bottom">
                            
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="625px" colspan="3">
                            <ul id="list-books">
                                <?php 
                                    echo showPaket($paket);
                                ?>
                            </ul>
                        </td>
                        <td valign="top" width="290px" align="right">
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
	<?php include_once 'views/footer.php'; ?>
    </body>
</html>
