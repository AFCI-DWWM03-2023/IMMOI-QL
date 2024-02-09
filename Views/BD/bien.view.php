<?php ob_start();
require_once "Controller/utilisateurController.php";
$utilisateurController = new UtilisateurController;
$DBuser = $utilisateurController->getUtilisateursList();
require_once "Controller/adresseController.php";
$adresseController = new AdresseController;
$DBadresse = $adresseController->getAdresseList();
require_once "Controller/photoController.php";
$photoController = new PhotoController;
$DBphoto = $photoController->getPhotoList();
require "departement.php";
$listephotos = $photoController->getPhotosByBien($bien->getId());
?>

<section class="content">
    <div class="bienoverview">
        <div class="gallery">
            <div class="displaycontainer">
                <?php if (empty($listephotos)) : ?>
                    <img src="/public/img/default.jpg" alt="" class="displayedimage">
                    <?php else :
                    foreach ($listephotos as $photo) :
                        if ($photo->getCouverture()) : ?>
                            <img src="/public/img/photos/<?= $photo->getNom(); ?>" alt="" class="displayedimage">
                <?php endif;
                    endforeach;
                endif; ?>
            </div>
            <div class="imagelist">
                <a href="/offres/<?= $bien->getId();?>/img" class="addimage">
                    Gérer les images
                </a>
                <?php if (empty($listephotos)) : ?>
                    <img src="/public/img/default.jpg" alt="" class="thumbimage active">
                    <?php else :
                    foreach ($listephotos as $photo) : ?>
                        <img src="/public/img/photos/<?= $photo->getNom(); ?>" alt="" class="thumbimage <?= ($photo->getCouverture()) ? "active" : "" ?>">

                <?php endforeach;
                endif; ?>
            </div>
        </div>
        <div class="details">
            <h2><?= $bien->getNom(); ?></h2>
            <h3>Publiée par <a href="/profil/<?= $bien->getUtilisateur() ?>"><?= $DBuser[$bien->getUtilisateur() - 1]->getUsername(); ?></a></h3>
            <h4><?= $bien->getDescription() ?></h4>
            <p class="infosbien">
            <p><?= ucwords($bien->getCategorie()) ?>
                <?= ($bien->getPrixLoc()) ? " en location : " . $bien->getPrixLoc() . "€/mois" : null; ?>
                <?= ($bien->getPrixVente()) ? " en vente : " . $bien->getPrixVente() . "€" : null; ?></p>
            <p><?= $bien->getNbPieces() . " pièces - " . $bien->getSurface() . "m²" ?>
                <?= ($bien->getNbEtages() != 0) ? "(" . $bien->getNbEtages() . " étages)" : null; ?></p>
            <p><?= ($bien->getCategorie() == "appartement") ? "Appartement n°" . $bien->getNumAppart() . " - " : null ?>
                <?= $DBadresse[$bien->getAdresse() - 1]->getNomVoie() ?></p>
            <p><?= $DBadresse[$bien->getAdresse() - 1]->getZipcode() . " " . $DBadresse[$bien->getAdresse() - 1]->getLocalite(); ?></p>
            <p><?= get_region_departement($DBadresse[$bien->getAdresse() - 1]->getZipcode())['departement'] . " (" . get_region_departement($DBadresse[$bien->getAdresse() - 1]->getZipcode())['region'] . ")"; ?></p>
            </p>

        </div>
    </div>
</section>
<script src="/scripts/gallery.js"></script>

<?php
$content = ob_get_clean();
$titre = "Bien";
require "Views/template.php";
