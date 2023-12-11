<?php ob_start(); ?>

<section>

    <label for="username">Nom d'utilisateur:</label>
    <input type="text" id="username">
    <label for="email">Adresse mail:</label>
    <input type="email" id="email">
    <label for="password">Mot de passe:</label>
    <input type="password" id="password">
    <label for="repeatpassword">Répéter le mot de passe:</label>
    <input type="password" id="repeatpassword">

    <input type="submit" value="Valider">

</section>


<?php
$content = ob_get_clean();
$titre = "Inscription";
require "template.php";