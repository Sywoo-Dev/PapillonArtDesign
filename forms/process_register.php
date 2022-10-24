<?php

if(!empty($_POST)){

    $email = htmlspecialchars($_POST["email"]);
    $name = htmlspecialchars($_POST["name"]);
    $subname = htmlspecialchars($_POST["subname"]);
    $pass = htmlspecialchars($_POST["password"]);
    $pass_confirm = htmlspecialchars($_POST["password_confirm"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $username = htmlspecialchars($_POST["username"]);

    $errors = array();

    if($email == null || $name == null || $subname == null || $pass == null || $pass_confirm == null || $gender == null || $username == null){
        $errors["missing_field"] = "Des champs sont manquants";
    }

    if(strlen($gender) > 1){
        $errors["gender_miss"] = "Le sexe renseigné n'est pas valide";
    }

    if(empty($errors)){

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors["incorrect_email"] = "Mail incorrect";
        }

        if($pass_confirm != $pass){
            $errors["pass_not_match"] = "Les mots de passes ne correspondent pas";
        }

        if(empty($errors)){

            include "../inc/data.php";

            $req = $pdo->prepare("SELECT * FROM users WHERE mail = ?");
            $req->bindParam(1, $email);

            $req->execute();

            if($result = $req->fetch()){
                $errors["account_already_register"] = "Ce compte est déjà enregistré";
            }

            if(empty($errors)){

                $encrypt_pass = password_hash($pass, PASSWORD_BCRYPT);

                $req = $pdo->prepare("INSERT INTO users (name, subname, password, mail, sexe, username) VALUES (?, ?, ?, ?, ?, ?)");
                $req->bindParam(1, $name);
                $req->bindParam(2, $subname);
                $req->bindParam(3, $encrypt_pass);
                $req->bindParam(4, $email);
                $req->bindParam(5, $gender);
                $req->bindParam(6, $username);

                $req->execute();

                header("Location: /login.php");
                exit();

            }

        }

    }

    session_start();
    $_SESSION["form_errors"] = $errors;
    header("Location: /register.php");
    exit();
}

?>