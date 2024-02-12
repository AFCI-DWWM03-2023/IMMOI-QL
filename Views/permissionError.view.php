<?php ob_start(); ?>

<section class="content">
    <h2>Vous n'avez pas la permission d'accéder à cette page</h2>
</section>

<?php
$content = ob_get_clean();
$titre = "Erreur";
require "Views/template.php";
