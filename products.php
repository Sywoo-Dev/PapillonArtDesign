<?php 

$PAGE = 1;
include 'inc/header.php';

include "inc/data.php";
$req = $pdo->prepare("SELECT * FROM products");
$req->execute();

$products = $req->fetchAll();


?>
<div class="container" style="padding-bottom: 40px;">
	<h2 class="text-center top_space">Nos Produits</h3>


		<div class="row">
			<?php foreach($products as $p){ ?>
				<div class="col-md-3">
					<div class="card mb-30"><a class="card-img-tiles" href="#" data-abc="true">
						<div class="inner">
							<div class="main-img"><img src="<?= $p->icon ?>" alt="Category"></div>
							<div class="thumblist"><img src="<?= $p->first_thumb ?>" alt="Category"><img src="<?= $p->second_thumb ?>" alt="Category"></div>
						</div></a>
						<div class="card-body text-center">
							<h4 class="card-title"><?= $p->name ?><br>
								<?php if($p->stock_id == -1){ ?>
									<span class="badge bg-success">En Stock</span>
								<?php }else{

									$req = $pdo->prepare("SELECT * FROM stocks WHERE id = ?");
									$req->bindParam(1, $p->stock_id);
									$req->execute();

									if($result = $req->fetch()){
										if($result->global <= 10 && $result->global > 0){
											echo '<span class="badge bg-warning">Stock Bas</span>';
										}
										if($result->global > 10){
											echo '<span class="badge bg-success">En Stock</span>';
										}
										if($result->global == 0){
											echo '<span class="badge bg-danger">Rupture</span>';
										}
									}else{
										echo '<span class="badge bg-success">En Stock</span>';
									}


								} ?>
							</h4>
							<p class="text-muted"><?= $p->price ?>€</p>
							<a class="btn btn-outline-primary btn-sm" href="#" data-abc="true">Détails du produit</a>
							<?php if(in_array($p->id, $return_cart)){ ?>
								<a class="btn btn-outline-success btn-sm" href="/forms/remove_cart.php?id=<?= $p->id ?>&redirect=<?= $_SERVER['REQUEST_URI'] ?>" data-abc="true">-</a>
								<span class="badge bg-secondary"><?= array_count_values($in_cart)[$p->id]; ?></span>
								<a class="btn btn-outline-success btn-sm" href="/forms/add_cart.php?id=<?= $p->id ?>&redirect=<?= $_SERVER['REQUEST_URI'] ?>" data-abc="true">+</a>
							<?php }else{ ?>
								<a class="btn btn-outline-success btn-sm" href="/forms/add_cart.php?id=<?= $p->id ?>&redirect=<?= $_SERVER['REQUEST_URI'] ?>" data-abc="true">Ajouter au pannier</a>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>


	</div>
	<?php include 'inc/footer.php'; ?>
