<?php ob_start(); ?>

<section class="sect1">
    <div class="sect1search">
        <div class="search searchgeneral">
            <label for="search">Rechercher un bien</label>
            <input type="search" class="searchbar" id="search" placeholder="Ex : Blablaville, maison, jardin">
            <input type="submit" value="Lancer la recherche" class="submitsearch">
        </div>
        <a href="regionsearch.html" class="search searchregion"><img src="img/france.png" alt="">Rechercher un bien par région</a>
    </div>
    <img src="./img/header.jpg" alt="header"> <!-- Crédit : Binyamin Mellish -->
    <div class="sect1image">
        <h1>IM'MOI</h1>
        <h2>Parce que c'est mieux d'être chez soi</h2>
    </div>
</section>
<section class="sectmobile">
    <a href="regionsearch.html" class="mobilesearchregion"><img src="img/france.png" alt="">Rechercher un bien par région</a>
</section>

<section class="sect2">

    blabla

</section>

<?php
$content = ob_get_clean();
$titre = "Accueil";
require "template.php";
