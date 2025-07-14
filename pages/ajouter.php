<?php
$categories = getAllCategories();
$user = $_SESSION['user'];
?>
<section class="d-flex justify-content-center align-items-center flex-column">
    <h1>Ajouter un objet</h1>
    <form action="traitements/traitement-ajout.php" class="upload" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nom" class="form-label text-center w-100">Nom</label>
            <input type="text" class="form-control" id="nom_objet" name="nom_objet" required>
        </div>
        <div class="mb-3">
            <label for="categorie" class="form-label text-center w-100">Catégorie</label>
            <select class="form-control" id="categorie" name="categorie" required>
                <option value="" disabled selected>Choisir une catégorie</option>
                <?php foreach ($categories as $categorie) { ?>
                    <option value="<?= $categorie['id_categorie'] ?>">
                        <?= $categorie['nom_categorie'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label text-center w-100">Choisir des images</label>
            <input type="file" class="form-control" id="file" name="file[]" multiple>
        </div>
        <input type="hidden" value="<?= $user['id_membre'] ?>" name="user_id">
        <div class="d-flex justify-content-center">
            <button type="submit" name="ajouter" class="btn">Ajouter</button>
        </div>
    </form>
    <div class="mt-3">
        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success">
                Objet ajouté avec succès !
            </div>
        <?php } elseif (isset($_GET['error'])) { ?>
            <div class="alert alert-danger">
                Erreur lors de l'ajout de l'objet.
            </div>
        <?php } ?>
    </div>
</section>