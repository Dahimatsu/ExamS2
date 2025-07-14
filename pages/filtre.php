<?php
$categories = getAllCategories();
if (isset($_POST['filter'])) {
    $categoryId = $_POST['category'];
    $objects = getObjectsByCategory($categoryId);
    if (count($objects) > 0) {
        $message = "Objets trouvés pour la catégorie sélectionnée.";
        $nbObjects = count($objects);
    } else {
        $message = "Aucun objet trouvé pour cette catégorie.";
    }
}
?>
<section>
    <div class="d-flex flex-column align-items-center">
        <h1 class="mb-4">Filtrer par catégorie</h1>
        <form action="?page=filtre" method="POST" class="w-100 filtre" style="max-width: 400px;">
            <div class="mb-3">
                <select name="category" id="category" class="form-select">
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?= $category['id_categorie'] ?>"><?= $category['nom_categorie'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" name="filter" class="btn w-100">Filtrer</button>
        </form>
    </div>
    <?php if (isset($objects) && !empty($objects)) { ?>
        <div class="text-center my-4">
            <?php if (isset($message)) { ?>
                <h2><?= $message ?></h2>
            <?php } ?>
            <?php if (isset($nbObjects)) { ?>
                <p>Nombre d'objets trouvés : <?= $nbObjects ?></p>
            <?php } ?>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <table class="table table-striped table-bordered w-50">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Nom de l'objet</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objects as $object) { ?>
                        <tr>
                            <td><?= $object['id_objet'] ?></td>
                            <td><?= $object['nom_objet'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</section>