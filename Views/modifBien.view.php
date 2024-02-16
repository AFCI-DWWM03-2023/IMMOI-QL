<?php ob_start();
require_once "Controller/adresseController.php";
$adresseController = new AdresseController;
$adresseBien = $adresseController->getManager()->getAdresseById($bien->getAdresse());
?>

<section class="content contentcenter">

    <?php if (isset($_SESSION["user"]) && $bien->getUtilisateur() == $_SESSION["user"]["id"]) : ?>
        <div class="inscon">
            <h2>Modifier une offre</h2>
            <form method="POST" action="<?= URL ?>offres/<?= $bien->getId(); ?>/modif/validation" enctype="multipart/form-data">
                <label for="nom">Nom de l'offre:</label>
                <input type="text" name="nom" id="nom" placeholder="32 caractères maximum" maxlength="32" class="searchbar" value="<?= $bien->getNom() ?>"><br>
                <label for="nom">Description:</label>
                <input type="text" name="desc" id="desc" value="<?= $bien->getDescription() ?>" class="searchbar"><br>
                <div><label for="vente">Vente </label>
                    <input type="radio" name="venteloc" value="vente" id="vente" <?= ($bien->getPrixVente() > 0) ? "checked" : "" ?>>
                    <label for="loc">Location </label>
                    <input type="radio" name="venteloc" value="loc" id="loc" <?= ($bien->getPrixLoc() > 0) ? "checked" : "" ?>>
                    <input type="number" name="prix" id="prix" value="<?= ($bien->getPrixVente() > 0) ? $bien->getPrixVente() : $bien->getPrixLoc() ?>" placeholder="Prix" class="searchbar w68">
                </div>
                <label for="categorie" id="categorie">Type de bien</label>
                <select name="categorie" id="categorie" class="searchbar w25">
                    <option value="maison" <?= ($bien->getCategorie() == "maison") ? "selected" : "" ?>>Maison</option>
                    <option value="appart" <?= ($bien->getCategorie() == "appart") ? "selected" : "" ?>>Appartement</option>
                    <option value="terrain" <?= ($bien->getCategorie() == "terrain") ? "selected" : "" ?>>Terrain</option>
                </select><br>
                <div>
                    <label for="nbpieces">Nombre de pièces </label>
                    <input type="number" name="nbpieces" id="nbpieces" value="<?= $bien->getNbPieces() ?>" min="0" class="searchbar w18">
                    <label for="prix">Nombre d'étages</label>
                    <input type="number" name="nbetages" id="nbetages" value="<?= $bien->getNbEtages() ?>" min="0" class="searchbar w18"><br>
                    <label for="surface">Surface (m²) </label>
                    <input type="number" name="surface" id="surface" value="<?= $bien->getSurface() ?>" min="0" class="searchbar w18">
                    <span id="checkappart" class="hide">
                    <label for="surface">Numéro d'appartement </label>
                    <input type="number" name="numappart" id="numappart" value="<?= $bien->getNumAppart() ?>" min="0" class="searchbar w18"></span>
                </div>
                <label for="adresse">Adresse : </label><span id="adresscorrect" title="Veuillez entrer une adresse complète"></span>
                <input type="text" name="adresse" id="adresse" value="<?= $adresseBien->getNomVoie() ?>" class="searchbar">
                <input type="text" name="zipcode" id="zipcode" maxlength="10" value="<?= $adresseBien->getZipcode() ?>" class="searchbar w30">
                <input type="text" name="localite" id="localite" maxlength="45" value="<?= $adresseBien->getLocalite() ?>" class="searchbar w68">
                <input type="checkbox" name="adressemodif" id="adressemodif" hidden><br>
                <input type="hidden" name="oldadresse" value="<?=$adresseBien->getId()?>">
                <input type="hidden" name="verifmodifbien" value="true">
                <input type="submit" value="Valider" id="validerinsc" class="submitsearch">
            </form>
        </div>
    <?php else : require("permissionError.view.php");
    endif; ?>
    <script src="/scripts/modifbien.js"></script>

</section>


<?php
$content = ob_get_clean();
$titre = "Modification d'un bien";
require "template.php";
