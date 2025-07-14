<?php
session_start();
require("../../includes/fonctions.php");

if(isset($_POST["seConnecter"])) {
    $email = $_POST["email"];
    $motdepasse = $_POST["password"];
    echo $email;
    echo $motdepasse;

    $user = isConnected($email, $motdepasse);

    if($user) {
        $_SESSION['user'] = $user;
        header('Location: ../home.php?page=accueil');
    } else {
        header('Location: ../index.php?page=login&error=invalid');
    }
}

if (isset($_POST['inscription'])) {
    $nom = $_POST['nom'];
    $date_de_naissance = $_POST['date_de_naissance'];
    $genre = $_POST['genre'];
    $email = $_POST['email'];
    $ville = $_POST['ville'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!isEmailExist($email)) {
        if (confirm_password($password, $confirm_password)) {
            addUser($nom, $date_de_naissance, $genre, $email, $ville, $motdepasse);
            header('Location: ../index.php?page=login');
        } else {
            header('Location: ../index.php?page=inscription&error=password');
        }
    } else {
        header('Location: ../index.php?page=inscription&error=email');
    }
}
