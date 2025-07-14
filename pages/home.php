<?php
session_start();
require('../includes/fonctions.php');
$page = $_GET['page'];
if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}
?>
    
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="../assets/images/icon.ico">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap-icons/font/bootstrap-icons.css"/>
    <link rel="stylesheet" href="../assets/fonts/ProductSans/productSans.css" />
    <title><?= ucfirst($page) ?></title>
</head>

<body class="d-flex flex-column min-vh-100">

    <header class="header mb-4 sticky-top">
        <nav class="navbar navbar-expand-md">
            <div class="container-fluid">
                <a href="modele.php?page=accueil" class="logo fs-4 text-decoration-none text-white">
                    <img src="../assets/images/logo-black.png" alt="Logo" class="logo-image">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDesktop">
                    <ul class="navbar-nav flex-row align-items-center">
                        <li class="nav-item">
                            <?php if ($page == 'accueil') { ?>
                                <a class="nav-link active" href="modele.php?page=accueil">
                                    <i class="bi bi-house-door-fill me-1"></i> Accueil
                                </a>
                            <?php } else { ?>
                                <a class="nav-link" href="modele.php?page=accueil">
                                    <i class="bi bi-house-door-fill me-1"></i> Accueil
                                </a>
                            <?php } ?>
                        </li>
                        <li class="nav-item ms-3">
                            <button class="btn btn-primary">Bouton</button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="offcanvas offcanvas-end bg-dark text-white" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h2 class="offcanvas-title logo" id="offcanvasNavbarLabel">
                    <img src="../assets/images/logo-white.png" alt="Logo" class="logo-image">
                    <span class="separator">|</span>
                    <span class="menu">MENU</span>
                </h2>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"
                    style="filter: invert(1);"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column justify-content-end">
                <ul class="navbar-nav flex-column align-items-end pe-3">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Open source</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Lien</a>
                    </li>
                </ul>
                <button class="btn btn-primary mt-3 align-self-end me-3">Bouton</button>
            </div>
        </div>
    </header>


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