<?php ob_start(); ?>

<section class="content">
    <a href="/bdtest/utilisateurs">Utilisateurs</a>
</section>


<?php
$content = ob_get_clean();
$titre = "Tests Base de Données";
require "template.php";
