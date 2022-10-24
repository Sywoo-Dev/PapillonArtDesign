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
include '../inc/data.php';

$req = $pdo->prepare("SELECT * FROM univers");
$req->execute();

$univers = $req->fetchAll();

$req = $pdo->prepare("SELECT * FROM categories");
$req->execute();

$cats = $req->fetchAll();

$errors = array();
if(!empty($_POST)){
	
	$name = htmlspecialchars($_POST["name"]);
	$need_size = 0;
	if(isset($_POST["need_size"])){
		$need_size = 1;
	}
	$gender = htmlspecialchars($_POST["gender"]);
	$univers = intval($_POST["univers"]);
	$description = htmlspecialchars($_POST["description"]);
	$price = doubleval($_POST["price"]);

	if($name == null || $gender == null){
		$errors["missing_fields"] = "Des champs sont manquants";
	}

	if(empty($errors)){
		$icon = "/img/" . upload($_FILES["icon"]);
		$first_thumb = "/img/" . upload($_FILES["first_thumb"]);
		$second_thumb = "/img/" . upload($_FILES["second_thumb"]);

		if(empty($errors)){

			$req = $pdo->prepare("INSERT INTO products (name, description, price, icon, first_thumb, second_thumb, need_size, gender, univers) 
								VALUES (?,?,?,?,?,?,?,?,?)");
			$req->bindParam(1, $name);
			$req->bindParam(2, $description);
			$req->bindParam(3, $price);
			$req->bindParam(4, $icon);
			$req->bindParam(5, $first_thumb);
			$req->bindParam(6, $second_thumb);
			$req->bindParam(7, $need_size);
			$req->bindParam(8, $gender);
			$req->bindParam(9, $univers);

			$req->execute();

		}

	}
}
function upload($file){
	if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
		$fileTmpPath = $file['tmp_name'];
		$fileName = $file['name'];
		$fileSize = $file['size'];
		$fileType = $file['type'];
		$fileNameCmps = explode(".", $fileName);
		$fileExtension = strtolower(end($fileNameCmps));
		$newFileName = md5(time() . $fileName) . '.' . $fileExtension;

		$uploadFileDir = '../img/';
		$dest_path = $uploadFileDir . $newFileName;

		if(move_uploaded_file($fileTmpPath, $dest_path))
		{
			return $newFileName;
		}
		else
		{
			$errors[$newFileName] = $newFileName . ' Non téléchargé';
		}
	}
}
?>

<div class="container top_space" id="main_container" style="padding-bottom: 40px; padding-top: 200px">

	<h1>Ajouter un produit</h1>

	<?php if(!empty($errors)){ ?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <ul>
		  	<?php foreach($errors as $e){
		  		echo "<li>" . $e . "</li>";
		  	} ?>
		  </ul>
		  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php } ?>

	<form method="POST" enctype="multipart/form-data">
		<div class="row">


			<div class="mb-3 col-md-12">
				<label class="form-label">Nom du produit</label>
				<input type="text" class="form-control" name="name" max="255">
			</div>

			<div class="mb-3 col-md-12">
				<label class="form-label">Image Principal</label>
				<input class="form-control" name="icon" type="file">
			</div>

			<div class="mb-3 col-md-6">
				<label class="form-label">Miniature 1</label>
				<input class="form-control" name="first_thumb" type="file">
			</div>

			<div class="mb-3 col-md-6">
				<label class="form-label">Miniature 2</label>
				<input class="form-control" name="second_thumb" type="file">
			</div>

			<div class="mb-3">
				<label class="form-label">Description</label>
				<textarea class="form-control" name="description" rows="3"></textarea>
			</div>

			<div class="form-check col-md-3">
				<input class="form-check-input" type="checkbox" name="need_size">
				<label class="form-check-label">
					Besoins de préciser une taille
				</label>
			</div>

			<div class="col-md-3">
				<label class="form-label">A qui s'adresse le produit</label>
				<select class="form-select" name="gender" aria-label="Default select example">
					<option value="F">Femme</option>
					<option value="H">Homme</option>
					<option value="O">Sans distinction</option>
				</select>
			</div>

			<div class="col-md-3">
				<label class="form-label">Univer du produit</label>
				<select class="form-select" name="univers" aria-label="Default select example">
					<?php foreach($cats as $cat){ ?>
                    <optgroup label="--- <?= $cat->name ?> ---">
						<?php foreach($univers as $u){ if($u->type == $cat->id){ ?>
							<option value="<?= $u->id ?>"><?= $u->name ?></option>
						<?php } } ?>
					</optgroup>
                    <?php } ?>
					<optgroup label="Autre"><option value="-1">Autre produit</option></optgroup>
				</select>
			</div>

			<div class="mb-3 col-md-3">
				<label class="form-label">Prix</label>
				<input class="form-control" name="price" type="number" min="0" max="10000" step="0.01">
			</div>


		</div>
		<button type="submit" class="btn btn-success">Ajouter</button>
	</form>

</div>

<?php include '../inc/footer.php'; ?>
