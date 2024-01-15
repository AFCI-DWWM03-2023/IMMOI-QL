<?php ob_start(); 
if (isset($_POST['userExiste'])) $userExiste = $_POST['userExiste'];
?>

<section class="content">

    <form method="POST" action="<?= URL ?>inscription/validation" enctype="multipart/form-data">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" name="username" id="username" required>
        <label for="email">Adresse mail:</label>
        <input type="email" name="email" id="email" required>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password" required>
        <label for="estAgent">Êtes-vous agent Im'moi?</label>
        <input type="checkbox" name="estAgent" id="estAgent">
        <label for="agence" id="agence">Agence</label>
        <select name="agence" id="agence">
        <?php
        for ($i = 0; $i < count($DBagence); $i++) : ?>
            <option value="<?= $DBagence[$i]->getId();?>">Agence <?= $DBagence[$i]->getNom();?></option>
        <?php endfor; ?>
        </select>
        

        <input type="submit" value="Valider">
    </form>
    <?php if (isset($userExiste)) echo "Le nom d'utilisateur et/ou l'adresse mail existe déjà"; ?>

</section>


<?php
$content = ob_get_clean();
$titre = "Inscription";
require "template.php";
