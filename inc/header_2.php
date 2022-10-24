<?php 
if(session_status() == PHP_SESSION_NONE){
	session_start();
}
include "namespace.php";
include "data.php";
if(!isset($PAGE)){
	$PAGE = 0;
}

$in_cart = array();

if(isset($_SESSION["user"])){
	if($_SESSION['user']->cart != null){
		$in_cart = explode(",", $_SESSION["user"]->cart);
	}
}


$return_cart = array_unique($in_cart);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="description" content="Venez créer la gaming room qui vous ressemble.">
	<meta property="og:image" content="/img/logo.png">
	<link rel="stylesheet" type="text/css" href="/css//bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/css/custom.css">
	<link rel="icon" type="image/png" href="/img/logo.png">
	<link rel="stylesheet" href="/owlcarousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="/owlcarousel/assets/owl.theme.default.min.css">
	<script src="https://kit.fontawesome.com/27283c1466.js" crossorigin="anonymous"></script>
	<title><?= $TITLE ?></title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
		<div class="container-fluid">
			<a class="navbar-brand" href="/"><img src="/img/logo.png" width="50"></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>


		</div>

		<div class="container-fluid">
			<h2>test</h2>
		</div>

		<div class="container-fluid">
			<h2>test</h2>
		</div>

		<div class="container-fluid">
			<h2>test</h2>
		</div>


	</nav>


	<!-- Modal -->
	<div class="modal fade" id="CartModal" tabindex="-1" aria-labelledby="CartModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="CartModalLabel">Mon Panier</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">

						<?php 
						$total = 0;
						foreach($return_cart as $c_id){
							$req = $pdo->prepare("SELECT * FROM products WHERE id = ?");
							$req->bindParam(1, $c_id);
							$req->execute();

							$product = $req->fetch();
							?>
							<!-- Element -->
							<div class="col-md-2"><img src="/img/logo.png" width="100%"></div>
							<div class="col-md-4"><h4><?= $product->name ?></h4><p><?= $product->description ?></p></div>
							<div class="col-md-3">
								<p style="white-space: nowrap;">
									Unitaire: <?= $product->price ?>€
									<br>
									Total: <?= $product->price * array_count_values($in_cart)[$c_id] ?>€
									<?php $total += ($product->price * array_count_values($in_cart)[$c_id]); ?>
								</p>
							</div>
							<div class="col-md-3"><h2><span class="badge rounded-pill bg-success"><?= array_count_values($in_cart)[$c_id] ?></span></h2></div>
							<!-- End Element -->
						<?php } ?>

					</div>
				</div>
				<div class="modal-footer">
					<a href="/order.php" class="float-start btn btn-large btn-primary">Commander</a>
					<p class="float-right">Total: <?= $total ?>€</p>
				</div>
			</div>
		</div>
	</div>