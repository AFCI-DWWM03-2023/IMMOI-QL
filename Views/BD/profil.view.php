<?php ob_start(); 
$monprofil = (isset($_SESSION["user"]) && $_SESSION["user"]["id"] == $user->getId()) ? true : false;
$qualif = (null !== $user->getPrenom()) ? $user->getPrenom() : $user->getUsername();
?>

<section class="content">
    <?= ($monprofil) ? "Mon profil" : "Profil de " . $qualif; ?>
    <?= $user->getId(); ?>
    <?= $user->getNom(); ?>
    <?= $user->getPrenom(); ?>
    <?= $user->getTelephone(); ?>
    <?= $user->getEmail(); ?>
    <?= $user->getAdresse(); ?>
    <?= $user->getEstAgent(); ?>
    <?= $user->getAgence(); ?>
</section>

<?php
$content = ob_get_clean();
$titre = "Profil";
require "Views/template.php";
