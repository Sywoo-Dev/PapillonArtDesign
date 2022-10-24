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
?>

<div class="container content" id="main_container" style="padding-top: 200px;">

    <h1 class="text-center text-uppercase">Your favorites</h1>

    <div class="row">
        <?php for($i=0;$i<8;$i++){ ?>
        <div class="col-md-3">
            <div class="favorit-container">
                <i class="fa-solid fa-heart fa-2xl favorit-hearth"></i>
                <div class="favorit-header"><img class="img-responsive favorit-img" src="https://via.placeholder.com/500x500/000000"></div>
                <a href="" class="btn btn-favorit">Add To Cart</a>
            </div>
        </div>
        <?php } ?>
    </div>

</div>


<?php include "inc/footer.php"; ?>
