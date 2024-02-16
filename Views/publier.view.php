<?php ob_start();
?>

<section class="content contentcenter">

    <?php if (isset($_SESSION['connecte'])) : ?>
        <div class="inscon">
            <h2>Publier une offre</h2>
            <form method="POST" action="<?= URL ?>publier/validation" enctype="multipart/form-data">
                <label for="nom">Nom de l'offre:</label>
                <input type="text" name="nom" id="nom" placeholder="32 caractères maximum" required maxlength="32" class="searchbar"><br>
                <label for="nom">Description:</label>
                <input type="text" name="desc" id="desc" class="searchbar"><br>
                <div><label for="vente">Vente </label>
                <input type="radio" name="venteloc" value="vente" id="vente" checked required>
                <label for="loc">Location </label>
                <input type="radio" name="venteloc" value="loc" id="loc" required>
                <input type="number" name="prix" id="prix" placeholder="Prix" required class="searchbar w68"></div>
                <label for="categorie">Type de bien:</label>
                <select name="categorie" id="categorie" class="searchbar w25">
                    <option value="maison">Maison</option>
                    <option value="appart">Appartement</option>
                    <option value="terrain">Terrain</option>
                </select><br>
                <div>
                <label for="nbpieces">Nombre de pièces:</label> 
                <input type="number" name="nbpieces" id="nbpieces" min="0" class="searchbar w18">
                <label for="nbetages">Nombre d'étages:</label> 
                <input type="number" name="nbetages" id="nbetages" min="0" required class="searchbar w18"></div>
                <div>
                <label for="surface">Surface (m²): </label>
                <input type="number" name="surface" id="surface" min="0" required class="searchbar w18">
                <span id="checkappart" class="hide">
                <label for="numappart">Numéro d'appartement: </label>
                <input type="number" name="numappart" id="numappart" min="0" class="searchbar w18"></span></div>
                <label for="adresse">Adresse: </label>
                <input type="text" name="adresse" id="adresse" placeholder="Nom de voie" required class="searchbar"><br>
                <input type="text" name="zipcode" id="zipcode" placeholder="Code postal" required maxlength="10" class="searchbar w30">
                <input type="text" name="localite" id="localite" placeholder="Localité" required maxlength="45" class="searchbar w68"><br>
                <label for="photocouv">Photo de couverture :</label>
                <input type="file" id="photocouv" name="photocouv" accept=".jpg, .jpeg, .png, .gif"><br>
                <span style="color:red" id="filesizewarning" class="hide">La photo ne doit pas dépasser 2Mo<br></span>
                <a id="removephoto" class="hide" onclick="removePhoto()" href="#">Supprimer l'image</a><br>
                <input type="hidden" name="verifpublier" value="true">
                <input type="submit" value="Publier" id="submitform" class="submitsearch">
            </form>
        </div>
    <?php
    else : echo "Connectez-vous pour acceder à cette page";
    endif; ?>
    <script src="scripts/publier.js"></script>

</section>


<?php
$content = ob_get_clean();
$titre = "Publier une offre";
require "template.php";
