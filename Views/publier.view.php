<?php ob_start();
?>

<section class="content">

    <?php if (isset($_SESSION['connecte'])) : ?>
        <form method="POST" action="<?= URL ?>publier/validation" enctype="multipart/form-data">
            <label for="nom">Nom de l'offre:</label>
            <input type="text" name="nom" id="nom" required maxlength="32">
            <label for="nom">Description:</label>
            <input type="text" name="desc" id="desc">
            <label for="vente">Vente </label>
            <input type="radio" name="venteloc" value="vente" id="vente" checked required>
            <label for="loc">Location </label>
            <input type="radio" name="venteloc" value="loc" id="loc" required>
            <label for="prix">Prix </label>
            <input type="number" name="prix" id="prix" required>
            <label for="categorie" id="categorie">Type de bien</label>
            <select name="categorie" id="categorie">
                <option value="maison">Maison</option>
                <option value="appart">Appartement</option>
                <option value="terrain">Terrain</option>
            </select>
            <label for="nbpieces">Nombre de pièces </label>
            <input type="number" name="nbpieces" id="nbpieces">
            <label for="prix">Nombre d'étages </label>
            <input type="number" name="nbetages" id="nbetages"><br>
            <label for="surface">Surface (m²) </label>
            <input type="number" name="surface" id="surface" required>
            <label for="surface">Numero appartement </label>
            <input type="number" name="numappart" id="numappart">
            <label for="adresse">Adresse : </label>
            <input type="text" name="adresse" id="adresse" required>
            <label for="zipcode">Code postal </label>
            <input type="text" name="zipcode" id="zipcode" required maxlength="10">
            <label for="localite">Localité (ville, village, etc) : </label>
            <input type="text" name="localite" id="localite" required maxlength="45">
            <label for="photocouv">Photo de couverture :</label>
            <input type="file" id="photocouv" name="photocouv" accept=".jpg, .jpeg, .png, .gif">
            <span style="color:red" id="filesizewarning" class="hide">La photo ne doit pas dépasser 2Mo</span>
            <a id="removephoto" class="hide" onclick="removePhoto()" href="#">Supprimer l'image</a>
            <input type="submit" value="Valider" id="submitform">
        </form>
    <?php
    else : echo "Connectez-vous pour acceder à cette page";
    endif; ?>
    <script src="scripts/publier.js"></script>

</section>


<?php
$content = ob_get_clean();
$titre = "Publier un bien";
require "template.php";
