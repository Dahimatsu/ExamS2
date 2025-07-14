<?php 
$objets = getAllObject();

?>
<section>
    <h1>Bienvenue sur la page d'accueil</h1>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Statut</th>
                <th scope="col">Date de retour</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($objets as $objet) { ?>
                <tr>
                    <td><?= $objet['id_objet']; ?></td>
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
</section>