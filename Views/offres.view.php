<?php ob_start();
require "departement.php" ?>

<section class="sectoffres">
    <?php for ($i = 0; $i < count($DBbien); $i++) :
        $listephotos = $photoController->getPhotosByBien($DBbien[$i]->getId());
        $couverture = 0;
        foreach ($listephotos as $photo) {
            if ($photo->getCouverture()) {
                $couverture = $photo->getId();
            }
        }
    ?>
        <div class="offre <?= ($i % 2) ? "pair" : "impair"; ?>">
            <div class="offrecontent">

                <a href="/offres/<?= $DBbien[$i]->getId() ?>"><img src="public/img/<?= ($couverture != 0) ? "photos/" . $DBphoto[0]->getNom() : "default.jpg"; ?>" class="photocouverture" alt=""></a>
                <div class="offreinfos">
                    <h3 class="nom">
                        <img src="public/img/icones/<?= $DBbien[$i]->getCategorie(); ?>.svg" alt="">
                        <?= $DBbien[$i]->getNom(); ?>
                    </h3>
                    <ul>
                        <li><?= ($DBbien[$i]->getPrixLoc()) ? "En location : " . $DBbien[$i]->getPrixLoc() . "€/mois" : null; ?>
                        <?= ($DBbien[$i]->getPrixVente()) ? "En vente : " . $DBbien[$i]->getPrixVente() . "€" : null; ?></li>
                        <li><?= ($DBbien[$i]->getCategorie() != "terrain") ? $DBbien[$i]->getNbPieces() . " pièces - " : ""; ?>
                        <?= $DBbien[$i]->getSurface() . "m²"; ?></li>
                        <li><?= $DBadresse[$DBbien[$i]->getAdresse() - 1]->getZipcode(); ?>
                        <?= $DBadresse[$DBbien[$i]->getAdresse() - 1]->getLocalite(); ?></li>
                        <li><?= get_region_departement($DBadresse[$DBbien[$i]->getAdresse() - 1]->getZipcode())['region']; ?></li>
                    </ul>
                    <a href="/offres/<?= $DBbien[$i]->getId() ?>" class="decouvrir <?= ($i % 2) ? "pair" : "impair"; ?>">Découvrir ></a>
                </div>
            </div>
        </div>
    <?php endfor; ?>
</section>


<?php
$content = ob_get_clean();
$titre = "Dernières offres";
require "template.php";
