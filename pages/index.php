<?php
require('../includes/fonctions.php');
$page = $_GET['page'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="../assets/images/icon.ico">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap-icons/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../assets/fonts/ProductSans/productSans.css" />
    <title><?= ucfirst($page) ?></title>
</head>

<body class="d-flex flex-column min-vh-100">
    <main class="flex-grow-1">
        <?php require($page . '.php'); ?>
    </main>

    <footer class="bg-dark text-light mt-5">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <span class="fw-bold me-1"><a href="?page=accueil">TJ Corporation</a></span>
                    <span class="fw-light"><i class="bi bi-c-circle me-1"></i>Juillet 2025 - Final Web S2</span>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <span class="me-3 d-inline"><strong>ETU004054</strong> | RAVELOMANANTSOA Tony Mahefa</span>
                    <span><strong>ETU004155</strong> | RAKOTOBE Joshua Riki</span>
                </div>
            </div>
        </div>
    </footer>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>