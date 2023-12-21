<?php ob_start(); ?>

<section class="content">

    <form method="POST" action="<?= URL ?>inscription/validation" enctype="multipart/form-data">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" name="username" id="username" required>
        <label for="email">Adresse mail:</label>
        <input type="email" name="email" id="email" required>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" value="Valider">
    </form>

</section>


<?php
$content = ob_get_clean();
$titre = "Inscription";
require "template.php";
