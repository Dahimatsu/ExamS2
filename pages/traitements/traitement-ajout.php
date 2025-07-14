<?php
require('../../includes/fonctions.php');

if (isset($_POST['ajouter'])) {
    $nom = $_POST['nom_objet'];
    $categorie = $_POST['categorie'];
    $userId = $_POST['user_id'];
    $fichiers = $_FILES['file'];

    ajouterNewObjet(ucfirst($nom), $categorie, $userId, $fichiers);

    header('Location: ../home.php?page=ajouter&success=uploaded');
    exit;
} else {
    header('Location: ../home.php?page=ajouter&error=invalid');
    exit;
}

