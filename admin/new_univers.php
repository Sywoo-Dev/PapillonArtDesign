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
	$type = intval($_POST["type"]);


	if($name == null){
		$errors["missing_fields"] = "Des champs sont manquants";
	}

	if(empty($errors)){
		$icon = "/img/" . upload($_FILES["icon"]);

		if(empty($errors)){

			$req = $pdo->prepare("INSERT INTO univers (name, icon, type) VALUES (?,?,?)");
			$req->bindParam(1, $name);
			$req->bindParam(2, $icon);
			$req->bindParam(3, $type);

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

<div class="container top_space content" id="main_container" style="padding-bottom: 40px; padding-top: 200px">

	<h1>Ajouter un univers</h1>

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
				<label class="form-label">Nom de l'univer</label>
				<input type="text" class="form-control" name="name" max="255">
			</div>

			<div class="mb-3 col-md-12">
				<label class="form-label">Image Principal</label>
				<input class="form-control" name="icon" type="file">
			</div>

			<div class="col-md-12">
				<label class="form-label">Univer du produit</label>
				<select class="form-select" name="type" aria-label="Default select example">
					<?php foreach ($cats as $cat){ ?>
                        <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
                    <?php } ?>
				</select>
			</div>


		</div>
		<button type="submit" class="btn btn-success" style="margin-top: 20px;">Ajouter</button>
	</form>

</div>

<?php include '../inc/footer.php'; ?>
