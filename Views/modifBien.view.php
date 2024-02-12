<?php ob_start();
require_once "Controller/adresseController.php";
$adresseController = new AdresseController;
$DBadresse = $adresseController->getAdresseList();
?>

<section class="content">

    <?php if (isset($_SESSION["user"]) && $bien->getUtilisateur() == $_SESSION["user"]["id"]) : ?>
        <form method="POST" action="<?= URL ?>offres/<?= $bien->getId(); ?>/modif/validation" enctype="multipart/form-data">
            <label for="nom">Nom de l'offre:</label>
            <input type="text" name="nom" id="nom" maxlength="32" value="<?= $bien->getNom() ?>">
            <label for="nom">Description:</label>
            <input type="text" name="desc" id="desc" value="<?= $bien->getDescription() ?>">
            <label for="vente">Vente </label>
            <input type="radio" name="venteloc" value="vente" id="vente" <?= ($bien->getPrixVente() > 0) ? "checked" : "" ?>>
            <label for="loc">Location </label>
            <input type="radio" name="venteloc" value="loc" id="loc" <?= ($bien->getPrixLoc() > 0) ? "checked" : "" ?>>
            <label for="prix">Prix </label>
            <input type="number" name="prix" id="prix" value="<?= ($bien->getPrixVente() > 0) ? $bien->getPrixVente() : $bien->getPrixLoc() ?>">
            <label for="categorie" id="categorie">Type de bien</label>
            <select name="categorie" id="categorie">
                <option value="maison" <?= ($bien->getCategorie() == "maison") ? "selected" : "" ?>>Maison</option>
                <option value="appart" <?= ($bien->getCategorie() == "appart") ? "selected" : "" ?>>Appartement</option>
                <option value="terrain" <?= ($bien->getCategorie() == "terrain") ? "selected" : "" ?>>Terrain</option>
            </select>
            <label for="nbpieces">Nombre de pièces </label>
            <input type="number" name="nbpieces" id="nbpieces" value="<?= $bien->getNbPieces() ?>">
            <label for="prix">Nombre d'étages</label>
            <input type="number" name="nbetages" id="nbetages" value="<?= $bien->getNbEtages() ?>"><br>
            <label for="surface">Surface (m²) </label>
            <input type="number" name="surface" id="surface" value="<?= $bien->getSurface() ?>">
            <label for="surface">Numéro appartement </label>
            <input type="number" name="numappart" id="numappart" value="<?= $bien->getNumAppart() ?>">
            <label for="adresse">Adresse : </label><span id="adresscorrect" title="Veuillez entrer une adresse complète"></span>
            <input type="text" name="adresse" id="adresse" value="<?= $DBadresse[$bien->getAdresse() - 1]->getNomVoie() ?>">
            <input type="text" name="zipcode" id="zipcode" maxlength="10" value="<?= $DBadresse[$bien->getAdresse() - 1]->getZipcode() ?>">
            <input type="text" name="localite" id="localite" maxlength="45" value="<?= $DBadresse[$bien->getAdresse() - 1]->getLocalite() ?>">
            <input type="checkbox" name="adressemodif" id="adressemodif" hidden><br>
            <input type="hidden" name="verifmodifbien" value="true">
            <input type="submit" value="Valider" id="validerinsc">
        </form>
    <?php else : require("permissionError.view.php");
    endif; ?>
    <script src="/scripts/modifbien.js"></script>

</section>


<?php
$content = ob_get_clean();
$titre = "Publier un bien";
require "template.php";
