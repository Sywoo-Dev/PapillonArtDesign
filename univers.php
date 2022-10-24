<?php 

$PAGE = 0;
include 'inc/header.php';

if(!isset($_SESSION["user"])){
	header("Location: /login.php");
	exit();
}

include "inc/data.php";
$req = $pdo->prepare("SELECT * FROM univers");
$req->execute();

$univers = $req->fetchAll();

$req = $pdo->prepare("SELECT * FROM categories");
$req->execute();

$cats = $req->fetchAll();

$selected = explode(",", $_SESSION["user"]->games);
?>

<div class="container content" style="padding-bottom: 40px;">

	<h1>Sélectionnez vos univers:</h1>
	<form>

		<div class="row top_space">

            <?php foreach ($cats as $cat){ ?>
			<div class="col-md-6 top_space">
				<h3 class="text-uppercase"><?= $cat->name ?></h3>
				<div class="row">
					<?php foreach($univers as $u){ 
						if(intval($u->type) == $cat->id){ ?>
							<div class="col-md-2 text-center">
								<?php if(!in_array($u->id, $selected)){ ?>
									<a href="/forms/add_game.php?id=<?= $u->id ?>">
										<img class="mx-auto d-block" src="<?= $u->icon ?>" width="100%" >
									</a>
								<?php }else{ ?>
									<a href="/forms/remove_game.php?id=<?= $u->id ?>">
										<img class="mx-auto d-block photo-gris" src="<?= $u->icon ?>" width="100%" >
									</a>								
								<?php } ?>		
								<p><?= $u->name ?></p>

							</div>
						<?php }
					} ?>
				</div>
			</div>
            <?php } ?>
		</div>


	</form>



</div>
<?php include 'inc/footer.php'; ?>
