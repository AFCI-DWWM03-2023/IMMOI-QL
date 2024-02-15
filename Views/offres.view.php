<?php ob_start();
require_once "Controller/adresseController.php";
$adresseController = new AdresseController;
$DBadresse = $adresseController->getAdresseList();
require_once "Controller/photoController.php";
$photoController = new PhotoController;
$DBphoto = $photoController->getPhotoList();
require "departement.php";
$searchresults = [
    "all" => "toutes les annonces",
    "maison" => "les maisons",
    "appart" => "les appartements",
    "terrain" => "les terrains",
    "venteloc" => "en vente ou location",
    "vente" => "en vente",
    "location" => "en location"
    ]?>

<section class="sectoffres">
    <?php if (isset($_POST["verifsearch"])) : ?>
        <div class="barrerecherche">
            <h3>Vous avez recherché <?= $searchresults[$_POST["searchcategorie"]] ?> <?= $searchresults[$_POST["searchventeloc"]] ?> <?= ($_POST["searchville"] != "") ? "à " . ucfirst($_POST["searchville"]) : "" ?> <?= ($_POST["searchprix"] != "") ? "avec un budget maximal de " . $_POST["searchprix"] . "€" : "sans limite de budget" ?><?= ($_POST["searchprix"] != "" && $_POST["searchventeloc"] == "location") ? " par mois" : "" ?>.</h3>
        </div>
    <?php endif; ?>
    <?php for ($i = 0; $i < count($listebiens); $i++) :
        $listephotos = $photoController->getPhotosByBien($listebiens[$i]->getId());
        $couverture = 0;
        foreach ($listephotos as $photo) {
            if ($photo->getCouverture()) {
                $couverture = $photo;
            }
        }
    ?>
        <div class="offre <?= ($i % 2) ? "pair" : "impair"; ?>">
            <div class="offrecontent">

                <a href="/offres/<?= $listebiens[$i]->getId() ?>"><img src="/public/img/<?= ($couverture !== 0) ? "photos/" . $couverture->getNom() : "default.jpg"; ?>" class="photocouverture" alt=""></a>
                <div class="offreinfos">
                    <h3 class="nom">
                        <img src="public/img/icones/<?= $listebiens[$i]->getCategorie(); ?>.svg" alt="">
                        <?= $listebiens[$i]->getNom(); ?>
                    </h3>
                    <ul>
                        <li><?= ($listebiens[$i]->getPrixLoc()) ? "En location : " . $listebiens[$i]->getPrixLoc() . "€/mois" : null; ?>
                            <?= ($listebiens[$i]->getPrixVente()) ? "En vente : " . $listebiens[$i]->getPrixVente() . "€" : null; ?></li>
                        <li><?= ($listebiens[$i]->getCategorie() != "terrain") ? $listebiens[$i]->getNbPieces() . " pièce" . (($listebiens[$i]->getNbPieces()!=1) ? "s" : "") . " - " : ""; ?>
                            <?= $listebiens[$i]->getSurface() . "m²"; ?></li>
                        <li><?= $adresseController->getManager()->getAdresseById($listebiens[$i]->getAdresse())->getZipcode(); ?>
                            <?= $adresseController->getManager()->getAdresseById($listebiens[$i]->getAdresse())->getLocalite(); ?></li>
                        <li><?= get_region_departement($adresseController->getManager()->getAdresseById($listebiens[$i]->getAdresse())->getZipcode())['region']; ?></li>
                    </ul>
                    <a href="/offres/<?= $listebiens[$i]->getId() ?>" class="decouvrir <?= ($i % 2) ? "pair" : "impair"; ?>"><span class="decouvrirtext">Découvrir</span> ></a>
                </div>
            </div>
        </div>
    <?php endfor; ?>
</section>


<?php
$content = ob_get_clean();
$titre = "Dernières offres";
require "template.php";
