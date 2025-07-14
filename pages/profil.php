
<?php
$objets = getUserObjects($user['id_membre']);

$objetsParCategorie = [];
foreach ($objets as $objet) {
    $categorie = $objet['nom_categorie'];
    if (!isset($objetsParCategorie[$categorie])) {
        $objetsParCategorie[$categorie] = [];
    }
    $objetsParCategorie[$categorie][] = $objet;
}
?>

<section class="container py-4">
    <h1 class="mb-4 text-center">Profil de l'utilisateur</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Informations personnelles</h5>
            <p class="card-text"><strong>Nom :</strong> <?= $user['nom'] ?></p>
            <p class="card-text"><strong>Email :</strong> <?= $user['email'] ?></p>
        </div>
    </div>

    <div class="mt-4">
    <h5>Mes objets</h5>
    <?php foreach ($objetsParCategorie as $categorie => $liste) { ?>
            <div class="mb-3">
                <h5><?= $categorie ?></h5>
                <ul class="list-group">
                    <?php foreach ($liste as $objet) { ?>
                        <li class="list-group-item">
                            <a href="home.php?page=detail&id=<?= $objet['id_objet'] ?>">
                                <?= htmlspecialchars($objet['nom_objet']) ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
    </div>

</section>