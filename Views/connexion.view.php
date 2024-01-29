<?php ob_start();
if (isset($_POST['connexionEchoue'])) $connexionEchoue = $_POST['connexionEchoue']; ?>

<section class="content contentcenter">
    <div class="inscon">
        <h2>CONNEXION</h2>
        <p class="error"><?php if (isset($connexionEchoue)) echo "Connexion échouée, le nom d'utilisateur ou le mot de passe est incorrect"; ?></p>
        <form method="POST" action="<?= URL ?>connexion/validation" enctype="multipart/form-data">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" required class="searchbar"><br>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required class="searchbar"><br>

            <input type="submit" value="Se connecter" class="submitsearch">
        </form>

        <p class="sinscrire">Pas de compte? <a href="/inscription">Inscrivez-vous</a></p>
    </div>
</section>


<?php
$content = ob_get_clean();
$titre = "Inscription";
require "template.php";
