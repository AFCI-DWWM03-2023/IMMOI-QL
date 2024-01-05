<?php ob_start(); ?>

<section class="content">
    <h2>L'utilisateur n'existe pas ou son compte a été supprimé</h2>
</section>

<?php
$content = ob_get_clean();
$titre = "Profil";
require "Views/template.php";
