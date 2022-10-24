<?php 

session_start();

if(isset($_SESSION["user"])){
	header("Location: /account.php");
	exit();
}

if(!empty($_POST)){

    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    $errors = array();

    if($email == null || $password == null) {
        $errors["missing_field"] = "Des champs sont manquants";
    }

    if(empty($errors)){
        include "../inc/data.php";

        $req = $pdo->prepare("SELECT * FROM users WHERE mail = ?");
        $req->bindParam(1, $email);

        $req->execute();

        if($account = $req->fetch()){

            if(password_verify($password, $account->password)){

                session_start();
                $_SESSION["user"] = $account;
                header("Location: /");
                exit();

            }else{
                $errors["bad_credentials"] = "Identifiants incorrects";
            }

        }else{
            $errors["account_not_found"] = "Ce compte n'existe pas";
        }

    }

    $_SESSION["form_errors"] = $errors;
    var_dump($_SESSION['form_errors']);
    header("Location: /login.php");
    exit();


}

?>