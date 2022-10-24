<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
if(!isset($_SESSION["user"])){
    header("Location: /login.php");
    exit();
}
if($_SESSION["user"]->rank != 1){
    header("Location: /");
    exit();
}

$PAGE = 1;
include '../inc/header.php';
include "../inc/data.php";
$req = $pdo->prepare("SELECT * FROM products");
$req->execute();

$allProducts = $req->fetchAll();

$req = $pdo->prepare("SELECT * FROM users");
$req->execute();

$allUsers = $req->fetchAll();


?>
<div class="container top_space" style="padding-bottom: 40px; padding-top: 200px">

	<div class="row">
		
		<div class="col-md-3">
			<div class="card">
				<div class="card-header">
					Produits
				</div>
				<div class="card-body">
					<h5 class="card-title"><?= Count($allProducts); ?></h5>
					<p class="card-text small">Totalité des produits enrgistrés.</p>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="card">
				<div class="card-header">
					Utilisateurs
				</div>
				<div class="card-body">
					<h5 class="card-title"><?= Count($allUsers); ?></h5>
					<p class="card-text small">Totalité des comptes enregistrés.</p>
				</div>
			</div>
		</div>


		<div class="col-md-3">
			<div class="card">
				<div class="card-header">
					Commandes
				</div>
				<div class="card-body">
					<h5 class="card-title"><?= "Cette année: " . Count($allProducts); ?></h5>
					<p class="card-text small">
						<span class="badge bg-info">Depuis le début: X</span>
						<span class="badge bg-warning">En attente: X</span>
						<span class="badge bg-success">Traités: X</span>
					</p>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="card">
				<div class="card-header">
					Somme Total <?= date("Y") ?>
				</div>
				<div class="card-body">
					<h5 class="card-title">XX XXX€</h5>
					<p class="card-text small">Total C.A sur le site cette année.</p>
				</div>
			</div>
		</div>

		<div class="d-grid gap-2 d-md-block top_space">
			<a class="btn btn-primary" href="new_product.php"><i class="fa-solid fa-plus"></i> Nouveau Produit</a>
            <a class="btn btn-primary" href="new_univers.php"><i class="fa-solid fa-plus"></i> Nouveau Univer</a>
            <a class="btn btn-primary" href="new_cat.php"><i class="fa-solid fa-plus"></i> Nouvelle Catégorie</a>
			<a class="btn btn-primary" href="#"><i class="fa-solid fa-list"></i> Pannel Commandes</a>
			<a class="btn btn-primary" href="#"><i class="fa-solid fa-shirt"></i> Pannel Produits</a>
			<a class="btn btn-primary" href="#"><i class="fa-solid fa-globe fa-spin"></i> Pannel Univers</a>
			<a class="btn btn-primary" href="#"><i class="fa-solid fa-users"></i> Pannel Utilisateurs</a>
			<a class="btn btn-primary" href="#"><i class="fa-solid fa-file-invoice"></i> Factures</a>
		</div>

	</div>

</div>

<?php include '../inc/footer.php'; ?>
