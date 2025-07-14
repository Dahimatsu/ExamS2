<?php

function dbconnect()
{
    static $connect = null;

    if ($connect === null) {
        $connect = mysqli_connect('localhost', 'root', '', 'etu4054_etu4155');

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
//         $connect = mysqli_connect('172.80.244.179', 'ETU004054', 'E1knMlkp', 'db_s2_ETU004054');

//         if (!$connect) {
//             die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
//         }

//         mysqli_set_charset($connect, 'utf8mb4');
//     }
//     return $connect;
// }