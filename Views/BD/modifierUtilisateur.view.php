<?php ob_start(); ?>

<section class="content">

    <form method="POST" action="<?= URL ?>bdtest/utilisateurs/mv" enctype="multipart/form-data">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" name="username" id="username" value="<?= $user->getUsername();?>" required>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password" value="<?= $user->getPassword();?>" required>
        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom" value="<?= $user->getNom();?>">
        <label for="prenom">Prenom:</label>
        <input type="text" name="prenom" id="prenom" value="<?= $user->getPrenom();?>">
        <label for="telephone">Téléphone:</label>
        <input type="text" name="telephone" id="telephone" value="<?= $user->getTelephone();?>">
        <label for="email">Adresse mail:</label>
        <input type="email" name="email" id="email" value="<?= $user->getEmail();?>" required>
        <label for="email">ID adresse:</label>
        <input type="number" name="idAdresse" id="idAdresse" value="<?= $user->getAdresse();?>">
        <input type="hidden" name="identifiant" value="<?= $user->getId(); ?>">

        <input type="submit" value="Valider">
    </form>

</section>


<?php
$content = ob_get_clean();
$titre = "Modification profil";
require "Views/template.php";
