<?php ob_start();
require_once "Controller/utilisateurController.php";
$utilisateurController = new UtilisateurController;
$DBuser = $utilisateurController->getUtilisateursList();
require_once "Controller/adresseController.php";
$adresseController = new AdresseController;
$DBadresse = $adresseController->getAdresseList();
require_once "Controller/photoController.php";
$photoController = new PhotoController;
$DBphoto = $photoController->getPhotoList();
?>

<section class="content">
    <td><?= $bien->getId(); ?></td>
    <td><?= $bien->getNom(); ?></td>
    <td><?= $bien->getDescription() ?></td>
    <td><?= $bien->getPrixLoc() ?></td>
    <td><?= $bien->getPrixVente() ?></td>
    <td><?= $bien->getCategorie() ?></td>
    <td><?= $bien->getNbPieces() ?></td>
    <td><?= $bien->getNbEtages() ?></td>
    <td><?= $bien->getSurface() ?></td>
    <td><?= $bien->getNumAppart() ?></td>
    <td><?= $DBuser[$bien->getUtilisateur() - 1]->getUsername(); ?></td>
    <td><?= $DBadresse[$bien->getAdresse() - 1]->getNomVoie() . " " . $DBadresse[$bien->getAdresse() - 1]->getZipcode() . " " . $DBadresse[$bien->getAdresse() - 1]->getLocalite(); ?></td>

    <div>photos :
        <?php $listephotos = $photoController->getPhotosByBien($bien->getId());
        $couverture = 0;
        foreach ($listephotos as $photo) {
            echo $photo->getNom();
            if ($photo->getCouverture()) {
                echo " (couverture)";
            }
            echo "<br>";
        } ?>
    </div>
</section>

<?php
$content = ob_get_clean();
$titre = "Bien";
require "Views/template.php";
