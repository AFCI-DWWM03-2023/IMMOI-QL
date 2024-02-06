<?php ob_start();
$url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);
$monprofil = (isset($_SESSION["user"]) && $_SESSION["user"]["id"] == $url[1]) ? true : false;
require_once "Controller/adresseController.php";
$adresseController = new AdresseController;
$DBadresse = $adresseController->getAdresseList();
require_once "Controller/photoController.php";
$photoController = new PhotoController;
$DBphoto = $photoController->getPhotoList();
$i = 1;
require "departement.php"
?>



<section class="sectoffres">
    <?php foreach ($listebien as $bien) :
        $i++;
        $listephotos = $photoController->getPhotosByBien($bien->getId());
        $couverture = 0;
        foreach ($listephotos as $photo) {
            if ($photo->getCouverture()) {
                $couverture = $photo->getId();
            }
        }
    ?>
        <div class="offre <?= ($i % 2) ? "pair" : "impair"; ?>">
            <div class="offrecontent">

                <a href="/offres/<?= $bien->getId() ?>"><img src="/public/img/<?= ($couverture != 0) ? "photos/" . $DBphoto[0]->getNom() : "default.jpg"; ?>" class="photocouverture" alt=""></a>
                <div class="offreinfos">
                    <h3 class="nom">
                        <img src="/public/img/icones/<?= $bien->getCategorie(); ?>.svg" alt="">
                        <?= $bien->getNom(); ?>
                    </h3>
                    <ul>
                        <li><?= ($bien->getPrixLoc()) ? "En location : " . $bien->getPrixLoc() . "€/mois" : null; ?>
                            <?= ($bien->getPrixVente()) ? "En vente : " . $bien->getPrixVente() . "€" : null; ?></li>
                        <li><?= ($bien->getCategorie() != "terrain") ? $bien->getNbPieces() . " pièces - " : ""; ?>
                            <?= $bien->getSurface() . "m²"; ?></li>
                        <li><?= $DBadresse[$bien->getAdresse() - 1]->getZipcode(); ?>
                            <?= $DBadresse[$bien->getAdresse() - 1]->getLocalite(); ?></li>
                        <li><?= get_region_departement($DBadresse[$bien->getAdresse() - 1]->getZipcode())['region']; ?></li>
                    </ul>
                    <a href="/offres/<?= $bien->getId() ?>" class="decouvrir <?= ($i % 2) ? "pair" : "impair"; ?>">Détails ></a>
                    <?php if ($monprofil) : ?>
                        <form method="POST" action="<?= URL ?>profil/<?= $url[1] ?>/offres/s/<?= $bien->getId(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer cette annonce ?');">
                            <button class="supprimer"><img src="/public/img/icones/trash.svg" alt=""></button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>

<?php
$content = ob_get_clean();
$titre = "Bien";
require "Views/template.php";
