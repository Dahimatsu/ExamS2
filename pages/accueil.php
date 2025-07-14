<?php 
if(!isset($_POST['rechercher'])) {
    $objets = getAllObject();
} else {
    $nomCategorie = $_POST['categorie_obj'];
    $nomObjet = $_POST['name_obj'];
    $disponible = isset($_POST['disponilbe']) ? true : false;
    $objets = searchObjet($nomCategorie, $nomObjet, $disponible);
}
$categories = getAllCategories();

?>
<section>
    <div class="text-center my-4">
        <h1>Bienvenue</h1>
    </div>

    <div class="d-flex justify-content-center my-4">
        <form method="post" class="p-4 bg-light w-50">
            <div class="mb-3">
                <label for="categorie_obj" class="form-label fw-bold">Catégorie</label>
                <select name="categorie_obj" id="categorie_obj" class="form-select">
                    <option value="">Toutes les catégories</option>
                    <?php foreach ($categories as $categorie) { ?>
                        <option value="<?= $categorie['nom_categorie']; ?>">
                            <?= $categorie['nom_categorie']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="name_obj" class="form-label fw-bold">Nom de l'objet</label>
                <input type="text" class="form-control" id="name_obj" name="name_obj">
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="disponible" name="disponilbe">
                <label class="form-check-label" for="disponible">Disponible uniquement</label>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" name="rechercher" class="btn btn-dark px-4">Rechercher</button>
            </div>
        </form>
    </div>
    <div class="d-flex justify-content-center">
        <table class="table table-striped table-bordered w-50">
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">Nom</th>
                    <th scope="col" class="text-center">Statut</th>
                    <th scope="col" class="text-center">Date de retour</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($objets as $objet) { ?>
                    <tr>
                        <td class="text-center"><?= $objet['id_objet']; ?></td>
                        <td>
                            <a href="home.php?page=detail&id=<?= $objet['id_objet']; ?>">
                                <?= $objet['nom_objet']; ?>
                            </a>
                        </td>
                        <?php if (isEmpruntEnCoursId($objet['id_objet'])) { ?>
                            <td><span class="badge bg-warning">Emprunt en cours</span></td>
                        <?php } else { ?>
                            <td><span class="badge bg-success">Disponible</span></td>
                        <?php } ?>
                        <td>
                            <?php if (isEmpruntEnCoursId($objet['id_objet'])) {
                                $dateRetour = getEmpruntRetour($objet['id_objet']);
                                echo $dateRetour;
                            } else {
                                echo 'N/A';
                            } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>