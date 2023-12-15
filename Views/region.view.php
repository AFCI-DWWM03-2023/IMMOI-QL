<?php ob_start(); ?>

<section>dadad</section>

<?php
$content = ob_get_clean();
$titre = "Recherche par région";
require "template.php";