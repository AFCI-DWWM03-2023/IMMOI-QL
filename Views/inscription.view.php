<?php ob_start();
if (isset($_POST['userExiste'])) $userExiste = $_POST['userExiste'];
?>

<section class="content contentcenter">

    <div class="inscon">
        <h2>INSCRIPTION</h2>
        <p class="error"><?php if (isset($userExiste)) echo "Le nom d'utilisateur et/ou l'adresse mail existe déjà"; ?></p>
        <form method="POST" action="<?= URL ?>inscription/validation" enctype="multipart/form-data">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" required class="searchbar"><br>
            <label for="email">Adresse mail</label>
            <input type="email" name="email" id="email" required class="searchbar"><br>
            <label for="password">Mot de passe</label><span class="conseil" title="8 caractères minimum. Pour une sécurité maximale, le mot de passe doit inclure une lettre miniscule, une lettre majuscule, un chiffre et un caractère spécial (&, @, #, etc)"> (?) </span><span id="complexite"></span><br>
            <input type="password" name="password" id="password" required class="searchbar"><br>
            <label for="repeatpassword">Répéter le mot de passe </label><span id="repeatcorrect" title="Les mots de passe doivent être identiques"></span><br>
            <input type="password" name="repeatpassword" id="repeatpassword" required class="searchbar"><br>
            <input type="hidden" name="verifinscription" value="true">
            <label for="estAgent">Êtes-vous agent Im'moi?</label>
            
            <input type="checkbox" name="estAgent" id="estAgent">
            <select name="agence" id="agence">
                <?php
                for ($i = 0; $i < count($DBagence); $i++) : ?>
                    <option value="<?= $DBagence[$i]->getId(); ?>">Agence <?= $DBagence[$i]->getNom(); ?></option>
                <?php endfor; ?>
            </select>
            <br>

            <input type="submit" value="S'inscrire" class="submitsearch" id="validerinsc" disabled>
        </form>
    </div>

</section>

<script src="scripts/inscription.js"></script>

<?php
$content = ob_get_clean();
$titre = "Inscription";
require "template.php";
