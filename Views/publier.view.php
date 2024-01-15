<?php ob_start(); 
?>

<section class="content">

    <form method="POST" action="<?= URL ?>publier/validation" enctype="multipart/form-data">
        <label for="nom">Nom de l'offre:</label>
        <input type="text" name="nom" id="nom" required>
        <label for="nom">Description:</label>
        <input type="text" name="desc" id="desc">
        <label for="vente">Vente </label>
        <input type="radio" name="venteloc" value="vente" id="vente" checked required>
        <label for="loc">Location </label>
        <input type="radio" name="venteloc" value="loc" id="loc" required>
        <label for="prix">Prix </label>
        <input type="number" name="prix" id="prix">
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
        <input type="number" name="surface" id="surface">
        <label for="adresse">Adresse : </label>
        <input type="text" name="adresse" id="adresse">
        <label for="zipcode">Code postal </label>
        <input type="number" name="zipcode" id="zipcode">
        <label for="localite">Localité (ville, village, etc) : </label>
        <input type="text" name="localite" id="localite">
        

        <input type="submit" value="Valider">
    </form>

</section>


<?php
$content = ob_get_clean();
$titre = "Publier un bien";
require "template.php";