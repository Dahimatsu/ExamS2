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
            <label for="categorie_obj">Choisir une catégorie: </label>
            <select name="categorie_obj" id="categorie_obj">
                <?php foreach ($categories as $categorie) { ?>
                    <option value="<?php echo $categorie['nom_categorie'];?>"><?php echo $categorie['nom_categorie'];?></option>
                <?php } ?>
            </select>
            <div class="mb-3">
                <p>
                    <input type="text" placeholder="Nom de l'objet" class="form-control" id="name_obj" name="name_obj" required>
                    Disponible <input type="radio" name="disponilbe"> 
                </p>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" name="rechercher" class="btn btn-dark">Valider</button>
            </div>
        </form>
    </div>

<?php if(isset('rechercher')) { ?>
    
    


<?php }else{ ?>
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
<?php } ?>
</section>