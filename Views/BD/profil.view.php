<?php ob_start(); ?>

<section class="content">
    <?= $user->getId(); ?>
    <?= $user->getUsername(); ?>
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
