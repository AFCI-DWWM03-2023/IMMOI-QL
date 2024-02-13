<?php ob_start();
require_once "Controller/bienController.php";
$bienController = new BienController;
$DBbien = $bienController->getBienList(); ?>

<section class="content contentcenter">
    <?php if ($DBbien[$bien - 1]->getUtilisateur() == $_SESSION["user"]["id"]) : ?>

        <div class="ajoutphoto">
            <form method="POST" action="<?= URL ?>offres/<?= $bien; ?>/img/v" enctype="multipart/form-data">
                <label for="nouvimage">Ajouter une nouvelle photo : </label><br>
                <input type="file" id="nouvimage" name="nouvimage" accept=".jpg, .jpeg, .png, .gif">
                <span style="color:red" id="filesizewarning" class="hide"><br>La photo ne doit pas dépasser 2Mo</span>
                <input type="submit" value="Valider" id="submitform">
            </form>
        </div>
        <?php if (!empty($listePhotos)) : ?>
            <table class="listephoto">
                <?php foreach ($listePhotos as $photo) : ?>
                    <tr>
                        <td>
                            <img src="/public/img/photos/<?= $photo->getNom(); ?>" alt="" class="preview">
                        </td>

                        <td>
                            <?php if ($photo->getCouverture()) : ?>
                                Photo de couverture
                            <?php else : ?>
                                <form method="POST" action="<?= URL ?>offres/<?= $bien; ?>/img/c/<?= $photo->getId(); ?>">
                                    <button>Choisir comme photo<br>de couverture</button>
                                </form>
                            <?php endif; ?>
                        </td>
                        <td>
                            <form method="POST" action="<?= URL ?>offres/<?= $bien; ?>/img/s/<?= $photo->getId(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer cette image ?');">
                                <button>Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
        <a class="submitsearch" href="<?= URL ?>offres/<?= $bien; ?>">Retour</a>

    <?php else : require("permissionError.view.php");
    endif; ?>
</section>
<br>
<br>
<script src="/scripts/gererPhoto.js"></script>

<?php
$content = ob_get_clean();
$titre = "Gestion de photos";
require "template.php";
