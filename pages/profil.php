
<?php
$user_ID = $_GET["user"];
$objets = getUserObjects($user_ID);
$user = getUserById($user_ID);
$Emprunts = getAllEmprunts($user['nom']);

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
                                <?= $objet['nom_objet'] ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
    </div>

    <div class="mt-4">
    <h5>Les objets que j'ai emprunté</h5>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nom Objet</th>
                <th scope="col">Rendre</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Emprunts as $emprunt) { ?>
                <tr>
                    <td><?= $emprunt['nom_objet'] ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="id_user" value="<?php echo $user_ID; ?>">
                            <input type="hidden" name="id_emprunt" value="<?= $emprunt['id_emprunt'] ?>">
                            <button type="submit" name="rendre" class="btn btn-danger">Rendre</button>
                        </form>

                        <form action="traitements/traitement-rendre.php" method="post">
                            <?php if (isset($_POST['rendre']) && $_POST['id_emprunt'] == $emprunt['id_emprunt']) { ?>
                                <select name="etat_objet" id="etat_objet">
                                    <option value="good">En bonne état</option>
                                    <option value="bad">Abimé</option>
                                </select>
                                <input type="hidden" name="id_emprunt" value="<?= $emprunt['id_emprunt'] ?>">
                                <button type="submit" name="rendre" class="btn btn-danger">Valider</button>
                            <?php } ?>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>

</section>