<?php ob_start();

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
<?php if (isset($hasSearched)) : ?>
    <div class="barrerecherche">
        <h3>Vous avez recherché <?=$searchresults[$_POST["searchcategorie"]]?> <?=$searchresults[$_POST["searchventeloc"]]?> <?=($_POST["searchville"] != "") ? "à " . ucfirst($_POST["searchville"]) : "" ?> <?=($_POST["searchprix"] != "") ? "avec un budget maximal de " . $_POST["searchprix"] . "€" : "sans limite de budget" ?><?= ($_POST["searchprix"] != "" && $_POST["searchventeloc"] == "location") ? " par mois" : "" ?>.</h3>
    </div>
<?php endif; ?>
<div class="nothingfound">
    <h1>Désolé, nous n'avons pas pu trouver d'offres correspondant à vos critères.</h1>
</div>
</div>


<?php
$content = ob_get_clean();
$titre = "Dernières offres";
require "template.php";
