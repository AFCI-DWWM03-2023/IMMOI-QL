<?php ob_start();

require "departement.php";
$searchresults = [
    "all" => "toutes les annonces",
    "maison" => "les maisons",
    "appart" => "les appartements",
    "terrain" => "les terrains",
    "venteloc" => "en vente ou location",
    "vente" => "en vente",
    "location" => "en location"
]

?>

<div class="content">
    <?php if (isset($_POST["verifsearch"])) : ?>
        <div class="barrerecherche">
            <h3>Vous avez recherché <?= $searchresults[$_POST["searchcategorie"]] ?> <?= $searchresults[$_POST["searchventeloc"]] ?> <?= ($_POST["searchville"] != "") ? "à " . ucfirst($_POST["searchville"]) : "" ?> <?= ($_POST["searchprix"] != "") ? "avec un budget maximal de " . $_POST["searchprix"] . "€" : "sans limite de budget" ?><?= ($_POST["searchprix"] != "" && $_POST["searchventeloc"] == "location") ? " par mois" : "" ?>.</h3>
        </div>
    <?php endif; ?>
    <?php if (isset($_POST["verifsearchdpt"])) : ?>
        <div class="barrerecherche">
            <h3>Vous avez recherché <?= $searchresults[$_POST["searchcategorie"]] ?> <?= $searchresults[$_POST["searchventeloc"]] ?> dans le département <?= get_region_departement($_POST["dptselect"])["departement"] ?> <?= ($_POST["searchprix"] != "") ? "avec un budget maximal de " . $_POST["searchprix"] . "€" : "sans limite de budget" ?><?= ($_POST["searchprix"] != "" && $_POST["searchventeloc"] == "location") ? " par mois" : "" ?>.</h3>
        </div>
    <?php endif; ?>
    <div class="nothingfound">
        <div class="color">
            <h1>Désolé, nous n'avons pas pu trouver d'offres correspondant à vos critères.</h1>
        </div>
    </div>
</div>


<?php
$content = ob_get_clean();
$titre = "Dernières offres";
require "template.php";
