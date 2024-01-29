<?php ob_start();
$monprofil = (isset($_SESSION["user"]) && $_SESSION["user"]["id"] == $user->getId()) ? true : false;
$qualif = (null !== $user->getPrenom()) ? $user->getPrenom() : $user->getUsername();
require_once "Controller/agenceController.php";
$agenceController = new AgenceController;
$DBagence = $agenceController->getAgenceList();
require_once "Controller/adresseController.php";
$adresseController = new AdresseController;
$DBadresse = $adresseController->getAdresseList();
?>

<section class="content contentcenter">
    <div class="profil">
        <h2><?= ($monprofil) ? "Mon profil" : "Profil de " . $qualif; ?></h2>
        <p>Nom d'utilisateur : <?=$user->getUsername();?></p>
        <p><?= ($user->getNom() != 0) ? "Nom de famille : ".$user->getNom() : ""?></p>
        <p><?= ($user->getPrenom() != 0) ? "Prénom : ".$user->getPrenom() : ""?></p>
        <p><?= ($user->getTelephone() != "") ? "Numéro de téléphone : ".$user->getTelephone() : ""?></p>
        <p><?= ($user->getAdresse() != 0) ? "Adresse : ".$DBadresse[$user->getAdresse()-1]->getNomVoie()." ".$DBadresse[$user->getAdresse()-1]->getZipcode()." ".$DBadresse[$user->getAdresse()-1]->getLocalite() : ""?></p>
        <p><?= ($user->getEmail() != 0) ? "Adresse mail : ".$user->getEmail() : ""?></p>
        <?= ($user->getEstAgent()) ? "Agent Im'moi" : ""; ?>
        <?= ($user->getEstAgent()) ? "Agence de " . $DBagence[$user->getAgence() - 1]->getNom() : ""; ?>
        <a href="/profil/edit"><?= ($monprofil) ? "Modifier mon profil" : ""?></a>
        <a href="/profil/<?= $user->getId() ?>/offres"><?= ($monprofil) ? "Mes annonces" : "Voir les annonces publiées par " . $qualif; ?></a>
    </div>
</section>

<?php
$content = ob_get_clean();
$titre = "Profil";
require "Views/template.php";
