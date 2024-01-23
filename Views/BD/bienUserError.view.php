<?php ob_start(); ?>

<section class="content">
    <h2>L'offre n'existe pas ou a été supprimée</h2>
</section>

<?php
$content = ob_get_clean();
$titre = "Bien";
require "Views/template.php";
