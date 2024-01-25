<?php ob_start();
$monprofil = (isset($_SESSION["user"]) && $_SESSION["user"]["id"] == $user->getId()) ? true : false;
$qualif = (null !== $user->getPrenom()) ? $user->getPrenom() : $user->getUsername();
require_once "Controller/agenceController.php";
$agenceController = new AgenceController;
$DBagence = $agenceController->getAgenceList();
?>

<section class="content">
    <?= ($monprofil) ? "Mon profil" : "Profil de " . $qualif; ?>
    <?= $user->getId(); ?>
    <?= $user->getNom(); ?>
    <?= $user->getPrenom(); ?>
    <?= $user->getTelephone(); ?>
    <?= $user->getEmail(); ?>
    <?= $user->getAdresse(); ?>
    <?= ($user->getEstAgent()) ? "Agent Im'moi" : ""; ?>
    <?= ($user->getEstAgent()) ? "Agence de " . $DBagence[$user->getAgence()-1]->getNom() : ""; ?>
    <a href="/profil/<?=$user->getId()?>/offres"><?= ($monprofil) ? "Mes annonces" : "Voir les annonces publiées par " . $qualif; ?></a>
</section>

<?php
$content = ob_get_clean();
$titre = "Profil";
require "Views/template.php";
