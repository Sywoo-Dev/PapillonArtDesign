<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
if(!isset($_SESSION["user"])){
    header("Location: /login.php");
    exit();
}

$PAGE = 1;
include 'inc/header.php';

$selected = explode(",", $_SESSION["user"]->games);

$req = $pdo->prepare("SELECT * FROM univers");
$req->execute();

$univers = $req->fetchAll();

$selected_univers = array();
foreach($univers as $u){
	if(in_array($u->id, $selected)){
		array_push($selected_univers, $u);
	}
}

$req = $pdo->prepare("SELECT * FROM categories");
$req->execute();

$cats = $req->fetchAll();

?>
<div class="container" id="main_container" style="padding-top: 200px">
<h1 class="text-center">Account</h1>

    <div class="profil">
        <h3 class="profil-title"><?= $_SESSION["user"]->username ?></h3>

        <div class="row top_space">
            <div class="col-md-4"><img class="profil-badge" src="/img/logo.png"></div>
            <div class="col-md-4"><img class="profil-badge" src="/img/logo.png"></div>
            <div class="col-md-4 profil-picture-container">
                <img class="profil-picture" src="/img/logo.png">
                <a href="#" class="profil-edit"><i class="fa-solid fa-pen-to-square fa-2xl"></i></a>
            </div>
            <div class="col-md-12 top_space"><p class="profil-ead">PAPILLON GAME</p></div>
        </div>

    </div>


    <div class="last-orders">
        <h3 class="profil-title">Last orders</h3>
        <div class="row top_space">
            <div class="col-md-2">
                <p class="text-center">100€</p>
                <img class="profil-order-icon" src="/img/logo.png">
                <p class="text-center">07/10/2022</p>
            </div>
        </div>
    </div>

    <div class="profil-settings">
        <h3 class="profil-title">Account Settings</h3>
        <div class="row top_space">
            <div class="col-md-4">
                <p class="profil-setting-header">Name <a href="" class="profil-edit"><i class="fa-solid fa-pen-to-square"></i></a></p>
                <p><?= $_SESSION["user"]->name . ' ' . $_SESSION["user"]->subname ?></p>
            </div>
            <div class="col-md-4">
                <p class="profil-setting-header">E-mail <a href="" class="profil-edit"><i class="fa-solid fa-pen-to-square"></i></a></p>
                <p><?= $_SESSION["user"]->mail ?></p>
            </div>
            <div class="col-md-4">
                <p class="profil-setting-header">Adress <a href="" class="profil-edit"><i class="fa-solid fa-pen-to-square"></i></a></p>
                <p><?= $_SESSION["user"]->adress ?></p>
                <p><?= $_SESSION["user"]->zip . " " . $_SESSION["user"]->city ?><i class="text-uppercase text-muted"><?= $_SESSION["user"]->country ?></i></p>
                <p><?= $_SESSION["user"]->adress_addon ?></p>
                <p></p>
            </div>
        </div>

        <a href="#" class="profil-password">Change your password</a>

    </div>

</div>





</div>
<?php include 'inc/footer.php'; ?>
