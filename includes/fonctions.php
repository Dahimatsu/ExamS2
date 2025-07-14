<?php
require('connexion.php');

function isConnected($mail, $motdepasse)
{
    $sql = "SELECT * 
            FROM ExamS2_membre 
            WHERE email = '%s' 
            AND mot_de_passe = '%s'";

    $sql = sprintf($sql, $mail, $motdepasse);
    $request = mysqli_query(dbConnect(), $sql);

    if (mysqli_num_rows($request) > 0) {
        return mysqli_fetch_assoc($request);
    } else {
        return null;
    }
}   

function isEmailExist($email)
{
    $sql = "SELECT * 
            FROM ExamS2_membre 
            WHERE email = '%s'";

    $sql = sprintf($sql, $email);
    $request = mysqli_query(dbConnect(), $sql);

    return mysqli_num_rows($request) > 0;
}

function addUser($nom, $date_de_naissance, $genre, $email, $ville, $password)
{
    $sql = "INSERT INTO ExamS2_membre (nom, date_de_naissance, genre, email, ville, mot_de_passe) 
            VALUES ('%s', '%s', '%s', '%s', '%s', '%s')";

    $sql = sprintf($sql, $nom, $date_de_naissance, $genre, $email, $ville, $password);
    return mysqli_query(dbConnect(), $sql);
}

function confirm_password($password, $confirm_password)
{
    return $password === $confirm_password;
}

function getAllObject() 
{
    $sql = "SELECT * FROM ExamS2_v_objet_lib";
    $query = mysqli_query(dbConnect(), $sql);
    $objects = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $objects[] = $row;
    }
    return $objects;
}

function isEmpruntEnCoursId($id) {
    $sql = "SELECT * 
            FROM ExamS2_v_emprunt_lib
            WHERE id_objet = '%s'";

    $sql = sprintf($sql, $id);
    $request = mysqli_query(dbConnect(), $sql);

    return mysqli_num_rows($request) > 0;
}

function getEmpruntRetour($id) {
    $sql = "SELECT date_retour 
            FROM ExamS2_v_emprunt_lib
            WHERE id_objet = '%s'";

    $sql = sprintf($sql, $id);
    $request = mysqli_query(dbConnect(), $sql);

    if (mysqli_num_rows($request) > 0) {
        return mysqli_fetch_assoc($request)['date_retour'];
    } else {
        return null;
    }
}

function getAllCategories() {
    $sql = "SELECT * FROM ExamS2_categorie_objet";
    $query = mysqli_query(dbConnect(), $sql);
    $categories = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $categories[] = $row;
    }
    return $categories;
}

function getObjectsByCategory($categoryId) {
    $sql = "SELECT * 
            FROM ExamS2_v_objet_lib
            WHERE id_categorie = '%s'";

    $sql = sprintf($sql, $categoryId);
    $query = mysqli_query(dbConnect(), $sql);
    $objects = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $objects[] = $row;
    }
    return $objects;
}

function insertImage($imageName, $userID)
{
    $sql = "INSERT INTO ExamS2_image_objet(nom_image) 
            VALUES ('%s')";

    $sql = sprintf($sql, $imageName, $userID);
    return mysqli_query(dbConnect(), $sql);
}
function upload($file, $user)
{
    $uploadDirectory = dirname(__DIR__) . '/assets/videos/';
    $maxSize = 100 * 1024 * 1024;
    $allowedFiles = ['video/mp4'];

    if ($file['error'] != UPLOAD_ERR_OK) {
        die('Erreur lors de l upload : ' . $file['error']);
    }

    if ($file['size'] > $maxSize) {
        die('Le fichier est trop volumineux.');
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    if (!in_array($mime, $allowedFiles)) {
        die('Type de fichier non autorisé : ' . $mime);
    }

    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = $originalName . '_' . uniqid() . '.' . $extension;

    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0755, true);
    }

    $destination = $uploadDirectory . $newName;

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        insertVideo($newName, $user);
    } else {
        echo "Échec du déplacement du fichier.";
    }
}
