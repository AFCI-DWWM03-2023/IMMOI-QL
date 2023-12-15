<?php ob_start(); ?>

<section class="sectoffres">
    <?php for ($i = 0; $i < count($DBbien); $i++) : ?>
        <div class="offre <?= ($i % 2) ? "pair" : "impair";?>">

            <?= $DBbien[$i]->getNom(); ?>
            <?= ($DBbien[$i]->getPrixLoc()) ? $DBbien[$i]->getPrixLoc() . "€/mois" : null; ?>
            <?= ($DBbien[$i]->getPrixVente()) ? $DBbien[$i]->getPrixVente() . "€" : null; ?>
            <?= $DBbien[$i]->getCategorie(); ?>
            <?= $DBbien[$i]->getNbPieces(); ?>
            <?= $DBbien[$i]->getNbEtages(); ?>
            <?= $DBbien[$i]->getSurface() . "m²"; ?>
            <?= $DBbien[$i]->getNumAppart(); ?>
            <?= $DBbien[$i]->getAdresse(); ?>
        </div>
    <?php endfor; ?>
</section>


<?php
$content = ob_get_clean();
$titre = "Dernières offres";
require "template.php";
