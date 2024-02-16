<?php ob_start();
require_once "Controller/adresseController.php";
$adresseController = new AdresseController;
if ($_SESSION['user']['adresse'] != 0) $adresseUser = $adresseController->getManager()->getAdresseById($_SESSION['user']['adresse']);
?>

<section class="content contentcenter">

    <?php if (isset($_SESSION['connecte'])) : ?>
        <div class="inscon">
            <h2>MODIFICATION DU PROFIL</h2>
            <form method="POST" action="<?= URL ?>profil/edit/v" enctype="multipart/form-data">
                <label for="nom">Nom de famille</label>
                <input type="text" name="nom" id="nom" class="searchbar" value="<?= $_SESSION['user']['nom'] ?>"><br>
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" class="searchbar" value="<?= $_SESSION['user']['prenom'] ?>"><br>
                <label for="email">Adresse mail</label>
                <input type="email" name="email" id="email" required class="searchbar" value="<?= $_SESSION['user']['email'] ?>"><br>
                <label for="telephone">Numéro de téléphone</label>
                <input type="text" name="telephone" id="telephone" class="searchbar" value="<?= $_SESSION['user']['telephone'] ?>"><br>
                <label for="adresse">Adresse </label><span id="adresscorrect" title="L'adresse doit être complète ou entièrement vide"></span>
                <input type="text" name="adresse" id="adresse" class="searchbar" placeholder="Nom de voie" value="<?= ($_SESSION['user']['adresse'] != 0) ? $adresseUser->getNomVoie() : ""; ?>"><br>
                <input type="text" name="zipcode" id="zipcode" class="searchbar" placeholder="Code postal" value="<?= ($_SESSION['user']['adresse'] != 0) ? $adresseUser->getZipcode() : ""; ?>"><br>
                <input type="text" name="localite" id="localite" class="searchbar" placeholder="Localité" value="<?= ($_SESSION['user']['adresse'] != 0) ? $adresseUser->getLocalite() : ""; ?>"><br>
                <input type="checkbox" name="adressemodif" id="adressemodif" hidden><br>
                <input type="hidden" name="oldadresse" value="<?= $adresseUser->getId() ?>">
                <input type="hidden" name="verifmodifprofil" value="true">

                <input type="submit" value="Valider les modifications" class="submitsearch" id="validerinsc">
            </form>
            <?php if (isset($_POST["erreuremail"])) echo "L'adresse mail entrée est déjà utilisée par un autre utilisateur"; ?>
        </div>
    <?php
    else : echo "Connectez-vous pour acceder à cette page";
    endif; ?>

</section>
<script src="/scripts/modifprofil.js"></script>

<?php
$content = ob_get_clean();
$titre = "Modification profil";
require "Views/template.php";
