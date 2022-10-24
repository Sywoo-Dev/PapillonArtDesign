<?php 

if(session_status() == PHP_SESSION_NONE){
	session_start();
}

if(!isset($_SESSION["user"])){
	header("Location: /login.php");
	exit();
}

if(!isset($_GET["id"])){
	header("Location: /univers.php");
	exit();
}

$game_id = intval($_GET["id"]);
$games = array();
if($_SESSION['user']->games != null){
	$games = explode(",", $_SESSION["user"]->games);
}

$str_game = "";
foreach($games as $g){
	if(intval($g) != intval($game_id)){
		$str_game = $str_game . $g . ",";
	}
}

$str_game = substr($str_game, 0, -1);

include '../inc/data.php';

$req = $pdo->prepare("UPDATE users SET games = ? WHERE id = ?");
$req->bindParam(1, $str_game);
$req->bindParam(2, $_SESSION['user']->id);

$req->execute();

$_SESSION['user']->games = $str_game;

header("Location: /univers.php");
exit();

?>