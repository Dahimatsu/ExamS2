<?php
require('../../includes/fonctions.php');
$user = $_POST['id_user'];
$objet = $_POST['id_objet'];
$duree = $_POST['duree'];

empreinter($user, $objet, $duree);
header('Location: ../home.php?page=accueil&success=emprunt');
exit;