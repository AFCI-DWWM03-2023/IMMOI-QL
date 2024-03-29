<?php ob_start();
$monprofil = (isset($_SESSION["user"]) && $_SESSION["user"]["id"] == $user->getId()) ? true : false;
$qualif = (null !== $user->getPrenom()) ? $user->getPrenom() : $user->getUsername();
require_once "Controller/agenceController.php";
$agenceController = new AgenceController;
require_once "Controller/adresseController.php";
$adresseController = new AdresseController;
$adresseUser = $adresseController->getManager()->getAdresseById($user->getId())
?>

<section class="content contentcenter">
    <div class="profil">
        <h2><?= ($monprofil) ? "Mon profil" : "Profil de " . $qualif; ?></h2>
        <p>Nom d'utilisateur : <?=$user->getUsername();?></p>
        <p><?= ($user->getNom() != "") ? "Nom de famille : ".$user->getNom() : ""?></p>
        <p><?= ($user->getPrenom() != "") ? "Prénom : ".$user->getPrenom() : ""?></p>
        <p><?= ($user->getTelephone() != "") ? "Numéro de téléphone : ".$user->getTelephone() : ""?></p>
        <p><?= ($user->getAdresse() != 0) ? "Adresse : ".$adresseUser->getNomVoie()." ".$adresseUser->getZipcode()." ".$adresseUser->getLocalite() : ""?></p>
        <p><?= ($user->getEmail() != "") ? "Adresse mail : ".$user->getEmail() : ""?></p>
        <?= ($user->getEstAgent()) ? "Agent Im'moi" : ""; ?>
        <?= ($user->getEstAgent()) ? "Agence de " . $agenceController->getManager()->getAgenceById($user->getAgence())->getNom() : ""; ?>
        <p><a href="/profil/edit"><?= ($monprofil) ? "Modifier mon profil" : ""?></a></p>
        <p><a href="/profil/<?= $user->getId() ?>/offres"><?= ($monprofil) ? "Mes annonces" : "Voir les annonces publiées par " . $qualif; ?></a></p>
        <p><a href="/profil/transactions"><?= ($monprofil && $_SESSION["user"]["estAgent"]) ? "Mes transactions" : ""?></a></p>
    </div>
</section>

<?php
$content = ob_get_clean();
$titre = ($monprofil) ? "Mon profil" : "Profil de " . $qualif;
require "Views/template.php";
