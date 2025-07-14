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

