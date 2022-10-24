<?php

$PAGE = 1;
include '../inc/header.php';
if(!isset($_SESSION["user"])){
    header("Location: /login.php");
    exit();
}
if($_SESSION["user"]->rank != 1){
    header("Location: /");
    exit();
}

include '../inc/data.php';

$errors = array();
if(!empty($_POST)) {

    $name = htmlspecialchars($_POST["name"]);

    if ($name == null) {
        $errors["missing_fields"] = "Des champs sont manquants";
    }

    $req = $pdo->prepare("SELECT * FROM categories");
    $req->execute();
    $result = $req->fetchAll();

    if(!empty($result)){
        $errors["exist"] = "La catégorie existe déjà";
    }

    if (empty($errors)) {

            $req = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
            $req->bindParam(1, $name);

            $req->execute();

            header("Location: /admin");
            exit();

    }
}
?>

<div class="container top_space content" id="main_container" style="padding-bottom: 40px; padding-top: 200px">

    <h1>Ajouter une Catégorie</h1>

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

    <form method="POST">
        <div class="row">


            <div class="mb-3 col-md-12">
                <label class="form-label">Nom de la catégorie</label>
                <input type="text" class="form-control" name="name" max="255">
            </div>



        </div>
        <button type="submit" class="btn btn-success" style="margin-top: 20px;">Ajouter</button>
    </form>

</div>

<?php include '../inc/footer.php'; ?>

