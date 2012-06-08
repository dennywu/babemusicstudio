<html>
    <head>
        <link href="/rent-band/css/site.css" rel="stylesheet" type="css/text"/>
        <link href="/rent-band/css/admin/category.css" rel="stylesheet" type="css/text"/>
        <script src="/rent-band/javascript/plugin/jquery.min.js"></script>
        <script src="/rent-band/javascript/plugin/GetParameter.js"></script>
        <script src="/rent-band/javascript/admin/category.js"></script>
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
            <table id="tblCategory" cellpadding="0" cellspacing="1" border="0">
                <thead>
                    <tr>
                        <td>*</td>
                        <td class="nameCategory">Nama Kategori</td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        <?php
            }
        ?>
    </body>
</html>
