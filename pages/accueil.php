<?php 
$objets = getAllObject();

?>
<section>
    <div class="text-center my-4">
        <h1>Bienvenue</h1>
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