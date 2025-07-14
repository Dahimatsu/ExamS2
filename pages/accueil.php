<?php 
$objets = getAllObject();
$categories = getAllCategories();

?>
<section>
    <div class="text-center my-4">
        <h1>Bienvenue</h1>
    </div>

    <div class="d-flex justify-content-center">
        <form method="post">
            <label for="categorie">Choisir une catégorie: </label>
            <select name="categorie_obj" id="categorie_obj">
                <?php foreach ($categories as $categorie) { ?>
                    <option value="volvo"><?php echo $categorie['nom_categorie'];?></option>
                <?php } ?>
            </select>
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
                        <td><?= $objet['nom_objet']; ?></td>
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