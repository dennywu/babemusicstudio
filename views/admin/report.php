<html>
    <head>
        <link href="/rent-band/css/site.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="/rent-band/css/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="/rent-band/css/report.css" />
        <script src="/rent-band/javascript/plugin/jquery.min.js" type="text/javascript"></script>
        <script src="/rent-band/javascript/plugin/jquery.quicksearch.js" type="text/javascript"></script>
        <script src="/rent-band/javascript/plugin/jquery-ui.js" type="text/javascript"></script>
        <script type="text/javascript" src="/rent-band/javascript/plugin/DateFormat.js"></script>
        <script type="text/javascript" src="/rent-band/javascript/admin/Report.js"></script>
        <script type="text/javascript" src="/rent-band/javascript/admin/DetailReservasi.js"></script>
        <script type="text/javascript" src="/rent-band/javascript/admin/DetailPerHari.js"></script>
        <script src="/rent-band/javascript/plugin/CurrencyRounding.js" type="text/javascript"></script>
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
            </div>
        <?php
            }
        ?>
    </body>
</html>