<?php ob_start(); ?>

<section class="content">
    <h2>Cet utilisateur n'a pas publié d'annonces</h2>
</section>

<?php
$content = ob_get_clean();
$titre = "Bien";
require "Views/template.php";
