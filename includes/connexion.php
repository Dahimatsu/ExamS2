<?php

function dbconnect()
{
    static $connect = null;

    if ($connect === null) {
        $connect = mysqli_connect('localhost', 'root', '', 'ExamS2');

        if (!$connect) {
            die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
        }

        mysqli_set_charset($connect, 'utf8mb4');
    }
    return $connect;
}

// Deploiement
// function dbconnect()
// {
//     static $connect = null;

//     if ($connect === null) {
//         $connect = mysqli_connect('localhost', 'ETU004054', 'E1knMlkp', 'db_s2_ETU004054');

//         if (!$connect) {
//             die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
//         }

//         mysqli_set_charset($connect, 'utf8mb4');
//     }
//     return $connect;
// }