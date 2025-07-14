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

function isEmpruntEnCoursId($id)
{
    $sql = "SELECT * 
            FROM ExamS2_v_emprunt_lib
            WHERE id_objet = '%s'";

    $sql = sprintf($sql, $id);
    $request = mysqli_query(dbConnect(), $sql);

    return mysqli_num_rows($request) > 0;
}

function getEmpruntRetour($id)
{
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

function getAllCategories()
{
    $sql = "SELECT * FROM ExamS2_categorie_objet";
    $query = mysqli_query(dbConnect(), $sql);
    $categories = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $categories[] = $row;
    }
    return $categories;
}

function getObjectsByCategory($categoryId)
{
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

function insertObjet($nom, $categorie, $userId)
{
    $conn = dbConnect();
    $sql = "INSERT INTO ExamS2_objet(nom_objet, id_categorie, id_membre) 
            VALUES ('%s', '%s', '%s')";
    $sql = sprintf($sql, $nom, $categorie, $userId);
    mysqli_query($conn, $sql);

    return mysqli_insert_id($conn);
}

function insertImage($imageName, $idObjet)
{
    $sql = "INSERT INTO ExamS2_image_objet(nom_image, id_objet) 
            VALUES ('%s', '%s')";
    $sql = sprintf($sql, $imageName, $idObjet);
    mysqli_query(dbConnect(), $sql);
}

function uploadImage($files, $idObjet)
{
    $uploadDirectory = dirname(__DIR__) . '/assets/images/objets/';
    $maxSize = 100 * 1024 * 1024;
    $allowedFiles = ['image/jpeg', 'image/png', 'image/gif'];

    $imagesValides = 0;

    for ($i = 0; $i < count($files['name']); $i++) {
        if ($files['error'][$i] !== UPLOAD_ERR_OK)
            continue;
        if ($files['size'][$i] > $maxSize)
            continue;

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $files['tmp_name'][$i]);
        finfo_close($finfo);

        if (!in_array($mime, $allowedFiles))
            continue;

        $extension = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
        $newName = uniqid() . '.' . $extension;

        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        $destination = $uploadDirectory . $newName;

        if (move_uploaded_file($files['tmp_name'][$i], $destination)) {
            insertImage($newName, $idObjet);
            $imagesValides++;
        }
    }

    if ($imagesValides === 0) {
        insertImage("default.jpg", $idObjet);
    }
}

function ajouterNewObjet($nomObjet, $categorie, $userId, $files)
{
    $idObjet = insertObjet($nomObjet, $categorie, $userId);
    uploadImage($files, $idObjet);
}

function getObjetById($id)
{
    $sql = "SELECT * 
            FROM ExamS2_v_objet_lib
            WHERE id_objet = '%s'";

    $sql = sprintf($sql, $id);
    $request = mysqli_query(dbConnect(), $sql);

    if (mysqli_num_rows($request) > 0) {
        return mysqli_fetch_assoc($request);
    } else {
        return null;
    }
}

function getObjectImages($id)
{
    $sql = "SELECT * 
            FROM ExamS2_image_objet
            WHERE id_objet = '%s'";

    $sql = sprintf($sql, $id);
    $request = mysqli_query(dbConnect(), $sql);
    $images = [];

    while ($row = mysqli_fetch_assoc($request)) {
        $images[] = $row;
    }

    return $images;
}

function getUserObjects($userId)
{
    $sql = "SELECT * 
            FROM ExamS2_v_objet_lib
            WHERE id_membre = '%s'";

    $sql = sprintf($sql, $userId);
    $request = mysqli_query(dbConnect(), $sql);
    $objects = [];

    while ($row = mysqli_fetch_assoc($request)) {
        $objects[] = $row;
    }

    return $objects;
}

function searchObjet($categorie, $nomObjet, $disponible)
{
    $conn = dbConnect();

    $categorie = mysqli_real_escape_string($conn, $categorie);
    $nomObjet = mysqli_real_escape_string($conn, $nomObjet);

    $sql = "SELECT * 
            FROM ExamS2_v_objet_lib
            WHERE 1=1";

    if (!empty($categorie)) {
        $sql .= " AND nom_categorie LIKE '%$categorie%'";
    }

    if (!empty($nomObjet)) {
        $sql .= " AND nom_objet LIKE '%$nomObjet%'";
    }

    if ($disponible) {
        $sql .= " AND nom_objet 
                  NOT IN (SELECT nom_objet FROM ExamS2_v_emprunt_lib)";
    }

    $request = mysqli_query($conn, $sql);
    $objects = [];

    while ($row = mysqli_fetch_assoc($request)) {
        $objects[] = $row;
    }

    return $objects;
}

function getUserById($userId)
{
    $sql = "SELECT * 
            FROM ExamS2_membre
            WHERE id_membre = '%s'";

    $sql = sprintf($sql, $userId);
    $request = mysqli_query(dbConnect(), $sql);

    if (mysqli_num_rows($request) > 0) {
        return mysqli_fetch_assoc($request);
    } else {
        return null;
    }
}



