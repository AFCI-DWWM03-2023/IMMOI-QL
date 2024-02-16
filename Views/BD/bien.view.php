<?php ob_start();
require_once "Controller/utilisateurController.php";
$utilisateurController = new UtilisateurController;
require_once "Controller/adresseController.php";
$adresseController = new AdresseController;
require_once "Controller/photoController.php";
$photoController = new PhotoController;
require "departement.php";
$listephotos = $photoController->getPhotosByBien($bien->getId());
$adresseBien = $adresseController->getManager()->getAdresseById($bien->getAdresse());
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
                <?php if (empty($listephotos)) : ?>
                    <img src="/public/img/default.jpg" alt="" class="thumbimage active">
                    <?php else :
                    foreach ($listephotos as $photo) : ?>
                        <img src="/public/img/photos/<?= $photo->getNom(); ?>" alt="" class="thumbimage <?= ($photo->getCouverture()) ? "active" : "" ?>">

                <?php endforeach;
                endif; ?>
                <?php if (isset($_SESSION["user"]["id"]) && $_SESSION["user"]["id"] == $bien->getUtilisateur()) : ?>
                    <a href="/offres/<?= $bien->getId(); ?>/img">
                        <div class="gererimage">Gérer les images</div>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="details">
            <h2><?= $bien->getNom(); ?></h2>
            <h3>Publiée par <a href="/profil/<?= $bien->getUtilisateur() ?>"><?= $utilisateurController->getManager()->getUserById($bien->getUtilisateur())->getUsername(); ?></a></h3>
            <h4><?= $bien->getDescription() ?></h4>
            <p class="infosbien">
            <p><?= ucwords($bien->getCategorie()) ?>
                <?= ($bien->getPrixLoc()) ? " en location : " . $bien->getPrixLoc() . "€/mois" : null; ?>
                <?= ($bien->getPrixVente()) ? " en vente : " . $bien->getPrixVente() . "€" : null; ?></p>
            <p><?= $bien->getNbPieces() . " pièces - " . $bien->getSurface() . "m²" ?>
                <?= ($bien->getNbEtages() != 0) ? "(" . $bien->getNbEtages() . " étages)" : null; ?></p>
            <p><?= ($bien->getCategorie() == "appartement") ? "Appartement n°" . $bien->getNumAppart() . " - " : null ?>
                <?= $adresseBien->getNomVoie() ?></p>
            <p><?= $adresseBien->getZipcode() . " " . $adresseBien->getLocalite(); ?></p>
            <p><?= get_region_departement($adresseBien->getZipcode())['departement'] . " (" . get_region_departement($adresseBien->getZipcode())['region'] . ")"; ?> <span title="Detecté automatiquement à partir du code postal entré par l'auteur de cette annonce." class="conseil">(?)</span></p>
            </p>

            <?php if (isset($_SESSION["user"]["id"]) && $_SESSION["user"]["id"] == $bien->getUtilisateur()) : ?>
                <a href="<?= $bien->getId(); ?>/modif">Modifier les informations</a>
            <?php endif; ?>
        </div>
    </div>
</section>
<script src="/scripts/gallery.js"></script>

<?php
$content = ob_get_clean();
$titre = "Bien";
require "Views/template.php";
