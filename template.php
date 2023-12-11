<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title><?= $titre ?> - Im'moi</title>
</head>

<body>
    <nav>
        <input type="checkbox" id="hamburger">
        <label for="hamburger" class="hbmenu">
            <div class="hbsect hbtop"></div>
            <div class="hbsect hbmid"></div>
            <div class="hbsect hbbot"></div>
        </label>
        <div class="menu">
            <ul>
                <a href="index.php"><li class="bgblue"><svg xmlns="http://www.w3.org/2000/svg" width="48px" fill="white" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                </svg>Accueil</li></a>
                <a href=""><li class="bglight">Mon compte</li></a>
                <a href=""><li class="bgblue">Mes annonces</li></a>
                <a href=""><li class="bglight">Nous contacter</li></a>
            </ul>
        </div>
        <div class="overlaymenu"></div>
        <a href="index.php" class="navbtn">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="48px" fill="white" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                </svg>
                <p>IM'MOI</p>
            </div>
        </a>
        <button class="navbtn accbtn">MON COMPTE</button>
    </nav>
    <?= $content ?>
    <footer>
        <div class="footerelem">IM'MOI - Agence Immobilière</div>
        <div class="footerelem">© Quentin LECLAIRE 2024</div>
    </footer>
</body>

</html>