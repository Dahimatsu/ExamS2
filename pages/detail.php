<?php
$id_Objet = $_GET['id'];
$objet = getObjetById($id_Objet);
$images = getObjectImages($id_Objet);
?>

<section class="container py-4">
    <h1 class="mb-4 text-center">Détails de l'objet</h1>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="card-title text-primary border-bottom border-primary pb-2 mb-3">Galerie</h4>

                    <?php if (!empty($images)) { ?>
                        <div id="objetGalleryCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php foreach ($images as $index => $image) { ?>
                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                        <div class="image-square">
                                            <img src="../assets/images/objets/<?= $image['nom_image'] ?>"
                                                alt="Image <?= $index + 1 ?>">
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#objetGalleryCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Précédent</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#objetGalleryCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Suivant</span>
                            </button>
                        </div>

                        <div class="d-flex overflow-auto pb-2">
                            <?php foreach ($images as $index => $image) { ?>
                                <div class="thumbnail-square <?= $index === 0 ? 'active' : '' ?>"
                                    data-bs-target="#objetGalleryCarousel" data-bs-slide-to="<?= $index ?>">
                                    <img src="../assets/images/objets/<?= $image['nom_image'] ?>"
                                        alt="Miniature <?= $index + 1 ?>">
                                </div>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="image-square">
                            <img src="../assets/images/objets/default.jpg" alt="Image par défaut">
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($objet['nom_objet']) ?></h5>
                    <p class="card-text">Catégorie : <?= htmlspecialchars($objet['nom_categorie']) ?></p>
                    <p class="card-text">Statut :
                        <?php if (isEmpruntEnCoursId($objet['id_objet'])) { ?>
                            <span class="badge bg-warning">Emprunt en cours</span>
                        <?php } else { ?>
                            <span class="badge bg-success">Disponible</span>
                        <?php } ?>
                    </p>
                    <p class="card-text">Date de retour prévue :
                        <?php
                        if (isEmpruntEnCoursId($objet['id_objet'])) {
                            echo htmlspecialchars(getEmpruntRetour($objet['id_objet']));
                        } else {
                            echo 'N/A';
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>