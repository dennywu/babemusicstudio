<?php
    ob_clean();
    session_start();
    if($_SESSION  != null)
    {
        header("Location:/rent-band/views/admin/home.php");
    }
?>
<html>
<head>
    <title>Login</title>
    <link href="/rent-band/css/login.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="section">
	    <div id='body' class="container">
		    <div class="login-form">
           	    <form id='logins' method='POST'  action="/rent-band/Application/admin/login.php" name="login" >
				    <h1>Masuk</h1>
				    <div class='formloginbody'>
					    <label for='username'>Email</label> <br/>
					    <input type='text' name='Username' class='input' style='width:21em;' autocapitalize='off' tabindex='1' required='required'/>
					    <br />
					    <label for='password'>Kata Sandi</label><br/>
					    <input type='password' name='Password' class='input' style='width:21em;' autocapitalize='off' tabindex='2' required='required'/>
					    <br/>
					    <input type='checkbox' name='RememberMe' class='remember' value="True"/> 
                                            <label id='labelRemember'>Biarkan saya tetap masuk</label>
					    <p><input type='submit' value='Masuk'/></p>
                                            <label id='error'></label>
			</div>
                    </form>
		    </div>
	    </div>
      </div>
   </body>
</html>