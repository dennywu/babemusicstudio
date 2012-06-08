<link href="/rent-band/css/navigation.css" rel="stylesheet" type="css/text"/>
<nav id="globalheader" class='apple globalheader-js noinset svg globalheader-loaded globalheader-loaded'>
			<ul id="globalnav" role="navigation">
				<li id="gn-store">
					<a href="/rent-band/views/admin/home.php">
						<span>Penyewaan</span>
					</a>
				</li>
				<li>
					<a href="/rent-band/views/admin/paket.php">
						<span>Paket</span>
					</a>
				</li>
				<li>
					<a href="/rent-band/views/admin/customer.php">
						<span>Pelanggan</span>
					</a>
				</li>
                                <li>
					<a href="/rent-band/Application/admin/logout.php">
						<span>Keluar</span>
					</a>
				</li>
				<li style="width:100%;text-align:right;padding-right:5px;padding-left:50px;">
					<div>
                                            <span style="text-align:right;padding-right:20px;color:#ccc;text-shadow: 0 0 0;">
                                                <?php 
                                                    echo "Selamat Datang, <strong>".$_SESSION['admin']."</strong>"; 
                                                ?>
                                            </span>
					<div>
				</li>
			</ul>
</nav>