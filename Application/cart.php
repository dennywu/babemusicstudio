<?php
// Include MySQL class
require_once('mysql.class.php');
// Include database connection
require_once('global.inc.php');
// Include functions
require_once('functions.inc.php');
// Start the session
session_start();
// Process actions
if(count($_SESSION['cart']) == 0){
    $cart[] = $_SESSION['cart'];
}
else
    $cart = $_SESSION['cart'];
$action = $_GET['action'];
switch ($action) {
	case 'add':
		if (count($cart)) {
                    if($cart[0] != null){
                        $newcart = array();
                        $issame = false;
                        foreach($cart as $c){
                            if($c["id"] == $_GET['id']){
                                $c["qty"]++;
                                array_push($newcart, $c);
                                $issame = true;
                            }
                            else{
                                array_push($newcart,$c);
                            }
                        }
                        $cart = $newcart;
                        if(!$issame){
                            array_push($cart, array("id"=>$_GET['id'],"hari"=>1,"qty"=>1));
                        }
                    }
                    else{
                        array_pop($cart);
                        array_push($cart, array("id"=>$_GET['id'],"hari"=>1,"qty"=>1));
                    }
		}
		break;
	case 'delete':
		if ($cart) {
                    $newcart = array();
                    foreach($cart as $c){
                        if($c["id"] == $_GET["id"]){
                        }
                        else{
                            array_push($newcart,$c);
                        }
                    }
                    $cart = $newcart;
                }
		break;
	case 'update':
	if ($cart) {
                $newcart = array();
                foreach($cart as $c){
                    if($c["id"] == $_POST["id"]){
                        $c["qty"] = $_POST["qty"];
                        $c["hari"] = $_POST["hari"];
                        array_push($newcart, $c);
                    }
                    else{
                        array_push($newcart,$c);
                    }
                }
                $cart = $newcart;
	}
	break;
}
$_SESSION['cart'] = $cart;
header("Location:/rent-band/rentalcart.php");
?>
