<?php 


if(session_status() == PHP_SESSION_NONE){
	session_start();
}

if(!isset($_SESSION["user"])){
	header("Location: /login.php");
	exit();
}

if(!isset($_GET["id"])){
	header("Location: /products.php");
	exit();
}

$redirect = htmlspecialchars($_GET["redirect"]);

if($redirect == null){
    $redirect = "";
}

$product_id = intval($_GET["id"]);
$products = array();

if($_SESSION['user']->cart != null){
	$products = explode(",", $_SESSION["user"]->cart);
}

$str_cart = "";
foreach($products as $p){
	if(intval($p) == $product_id){
        continue;
    }
    $str_cart = $str_cart . $p . ",";
}

$str_cart = substr($str_cart, 0, -1);

include '../inc/data.php';

$req = $pdo->prepare("UPDATE users SET cart = ? WHERE id = ?");
$req->bindParam(1, $str_cart);
$req->bindParam(2, $_SESSION['user']->id);

$req->execute();

$_SESSION['user']->cart = $str_cart;

header("Location: " . $redirect);
exit();
?>