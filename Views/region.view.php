<?php ob_start(); ?>

<section class="content">

</section>

<?php
$content = ob_get_clean();
$titre = "Recherche par région";
require "template.php";