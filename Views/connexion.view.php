<?php ob_start(); 
if (isset($_POST['connexionEchoue'])) $connexionEchoue = $_POST['connexionEchoue'];?>

<section class="content">

    <form method="POST" action="<?= URL ?>connexion/validation" enctype="multipart/form-data">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" name="username" id="username" required>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" value="Valider">
    </form>
    <?php if (isset($connexionEchoue)) echo "Connexion échouée, le nom d'utilisateur ou le mot de passe est incorrect"; ?>

    <p>Pas de compte? <a href="/inscription">Inscrivez-vous</a></p>

</section>


<?php
$content = ob_get_clean();
$titre = "Inscription";
require "template.php";
