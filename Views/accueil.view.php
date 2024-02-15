<?php ob_start();
require "departement.php"; ?>

<section class="sect1">
    <div class="sect1search">
        <form method="POST" action="<?= URL ?>recherche" enctype="multipart/form-data" class="search searchgeneral">
            <h3>Lancer une recherche</h3>
            <div>
                <input type="text" class="searchbar" id="searchville" name="searchville" placeholder="Ville">
                <input type="number" class="searchbar" id="searchprix" name="searchprix" placeholder="Budget maximum">
            </div>
            <div>
                <select name="searchventeloc" id="searchventeloc" class="searchbar w50">
                    <option value="venteloc">Vente et location</option>
                    <option value="vente">Vente seulement</option>
                    <option value="location">Location seulement</option>
                </select>
                <select name="searchcategorie" id="searchcategorie" class="searchbar w50">
                    <option value="all">Tous types</option>
                    <option value="maison">Une maison</option>
                    <option value="appart">Un appartement</option>
                    <option value="terrain">Un terrain</option>
                </select>
            </div>
            <input type="hidden" name="verifsearch" value="true"><br>
            <input type="submit" value="Lancer la recherche" class="submitsearch">
        </form>
        <a href="region" class="search searchregion"><img src="public/img/france.png" alt="">Rechercher un bien par région</a>
    </div>
    <img src="public/img/header.jpg" alt="header"> <!-- Crédit : Binyamin Mellish -->
    <div class="sect1image">
        <h1>IM'MOI</h1>
        <h2>C'est quand même mieux d'être chez soi</h2>
    </div>
</section>

<section class="sectmobile2">
    <form method="POST" action="<?= URL ?>recherche" enctype="multipart/form-data" class="searchmobile">
        <h3>Lancer une recherche</h3>
        <div>
            <input type="text" class="searchbar" id="searchville" name="searchville" placeholder="Ville">
            <input type="number" class="searchbar" id="searchprix" name="searchprix" placeholder="Budget max">
        </div>
        <div>
            <select name="searchventeloc" id="searchventeloc" class="searchbar w50">
                <option value="venteloc">Vente et location</option>
                <option value="vente">Vente seulement</option>
                <option value="location">Location seulement</option>
            </select>
            <select name="searchcategorie" id="searchcategorie" class="searchbar w50">
                <option value="all">Tous types</option>
                <option value="maison">Une maison</option>
                <option value="appart">Un appartement</option>
                <option value="terrain">Un terrain</option>
            </select>
        </div>
        <input type="hidden" name="verifsearch" value="true">
        <input type="submit" value="Lancer la recherche" class="submitsearch">
    </form>
</section>

<section class="sectmobile1">
    <a href="region" class="mobilesearchregion"><img src="public/img/france.png" alt="">Rechercher un bien par région</a>
</section>

<section class="sect3 contentcenter">
    <h2>Selection d'offres</h2>
    <div class="caroussel">
        <div id="carousselaleft">
            <</div>
                <?php foreach ($caroussel as $value) :
                    $bienCaroussel = $bienController->getManager()->getBienById($value->getBien());
                    $adresseCaroussel = $adresseController->getManager()->getAdresseById($bienCaroussel->getId()) ?>
                    <a href="offres/<?= $value->getBien(); ?>" class="carousselitem">
                        <img src="public/img/photos/<?= $value->getNom(); ?>" alt="">
                        <p><?= $bienCaroussel->getNom(); ?><br>
                            <?= $adresseCaroussel->getLocalite(); ?> (<?= get_region_departement($adresseCaroussel->getZipcode())["region"]; ?>)<br>
                            <?= ($bienCaroussel->getPrixLoc() > 0) ? $bienCaroussel->getPrixLoc() . "€/mois" :  $bienCaroussel->getPrixVente() . "€"; ?>
                        </p>
                    </a>
                <?php endforeach; ?>

                <div id="carousselaright">></div>
        </div>
</section>

<section class="sect2">

    <h2>Pourquoi choisir Im'moi?</h2>

    <div class="s2container">
        <div>
            <div><svg xmlns="http://www.w3.org/2000/svg" height="100" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                    <path d="M480 48c0-26.5-21.5-48-48-48H336c-26.5 0-48 21.5-48 48V96H224V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V96H112V24c0-13.3-10.7-24-24-24S64 10.7 64 24V96H48C21.5 96 0 117.5 0 144v96V464c0 26.5 21.5 48 48 48H304h32 96H592c26.5 0 48-21.5 48-48V240c0-26.5-21.5-48-48-48H480V48zm96 320v32c0 8.8-7.2 16-16 16H528c-8.8 0-16-7.2-16-16V368c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16zM240 416H208c-8.8 0-16-7.2-16-16V368c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16zM128 400c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V368c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32zM560 256c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H528c-8.8 0-16-7.2-16-16V272c0-8.8 7.2-16 16-16h32zM256 176v32c0 8.8-7.2 16-16 16H208c-8.8 0-16-7.2-16-16V176c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16zM112 160c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V176c0-8.8 7.2-16 16-16h32zM256 304c0 8.8-7.2 16-16 16H208c-8.8 0-16-7.2-16-16V272c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32zM112 320H80c-8.8 0-16-7.2-16-16V272c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16zm304-48v32c0 8.8-7.2 16-16 16H368c-8.8 0-16-7.2-16-16V272c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16zM400 64c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H368c-8.8 0-16-7.2-16-16V80c0-8.8 7.2-16 16-16h32zm16 112v32c0 8.8-7.2 16-16 16H368c-8.8 0-16-7.2-16-16V176c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16z" />
                </svg></div>
            <h3>La disponibilité</h3>
            <p>Avec <b><?= $agenceNombre ?></b> agences implantées partout en France, vous pouvez être sûr de trouver ce que vous voulez à l'endroit que vous voulez.</p>
        </div>
        <div>
            <div><svg xmlns="http://www.w3.org/2000/svg" height="100" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                    <path d="M96 128a128 128 0 1 0 256 0A128 128 0 1 0 96 128zm94.5 200.2l18.6 31L175.8 483.1l-36-146.9c-2-8.1-9.8-13.4-17.9-11.3C51.9 342.4 0 405.8 0 481.3c0 17 13.8 30.7 30.7 30.7H162.5c0 0 0 0 .1 0H168 280h5.5c0 0 0 0 .1 0H417.3c17 0 30.7-13.8 30.7-30.7c0-75.5-51.9-138.9-121.9-156.4c-8.1-2-15.9 3.3-17.9 11.3l-36 146.9L238.9 359.2l18.6-31c6.4-10.7-1.3-24.2-13.7-24.2H224 204.3c-12.4 0-20.1 13.6-13.7 24.2z" />
                </svg></div>
            <h3>L'accompagnement</h3>
            <p>Nos <b><?= $agentsNombre ?></b> agents sont toujours disponibles pour répondre à toutes vos demandes, et en plus il sentent très bon.</p>
        </div>
        <div>
            <div><svg xmlns="http://www.w3.org/2000/svg" height="100" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                    <path d="M96 96V320c0 35.3 28.7 64 64 64H576c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H160c-35.3 0-64 28.7-64 64zm64 160c35.3 0 64 28.7 64 64H160V256zM224 96c0 35.3-28.7 64-64 64V96h64zM576 256v64H512c0-35.3 28.7-64 64-64zM512 96h64v64c-35.3 0-64-28.7-64-64zM288 208a80 80 0 1 1 160 0 80 80 0 1 1 -160 0zM48 120c0-13.3-10.7-24-24-24S0 106.7 0 120V360c0 66.3 53.7 120 120 120H520c13.3 0 24-10.7 24-24s-10.7-24-24-24H120c-39.8 0-72-32.2-72-72V120z" />
                </svg></div>
            <h3>L'argent</h3>
            <p>Nous aimons l'argent. Veuillez dépenser votre argent chez nous SVP merci :)</p>
        </div>
    </div>

    <!-- banniere -->

</section>
<script src="scripts/caroussel.js"></script>


<?php
$content = ob_get_clean();
$titre = "Accueil";
require "template.php";
