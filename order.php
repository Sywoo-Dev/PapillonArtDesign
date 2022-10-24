<?php 

$PAGE = 0;
include 'inc/header.php';

if(!isset($_SESSION["user"])){
	header("Location: /login.php");
	exit();
}
?>
<style type="text/css">
	.underline{
		border-top: solid 5px black;
		padding-bottom: 30px;
		width: 100%;
	}
</style>
<div class="container top_space" style="padding-bottom: 40px">
	<h1 class="text-center">Mon panier</h1>
	<div class="row top_space">
		<div class="col-9"></div>
		<div class="col-md-3"><h1>Quantité</h1></div>
		<div class="col-md-12 underline"></div>
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
			<a href="#" class="float-right btn btn-success btn-block">Valider et payer</a>
	</div>
</div>
<?php include 'inc/footer.php'; ?>
