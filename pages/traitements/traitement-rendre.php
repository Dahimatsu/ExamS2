<?php 
require('../../includes/fonctions.php');

if(isset($_POST['id_emprunt']) && isset($_POST['id_user'])) {
    $id_emprunt = $_POST['id_emprunt'];
    $id_user = $_POST['id_user'];

    rendreEmprunt($id_emprunt);
    header('Location: ../home.php?page=profil&user=' . $id_user);
}
