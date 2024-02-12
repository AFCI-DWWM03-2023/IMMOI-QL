<?php ob_start(); 
require_once "Controller/bienController.php";
$bienController = new BienController;
$DBbien = $bienController->getBienList();?>

<section class="content">
    <?php if ($DBbien[$bien-1]->getUtilisateur() == $_SESSION["user"]["id"]) : ?>
        <div class="gestionPhotos">
            <div class="object">
                <form method="POST" action="<?= URL ?>offres/<?= $bien; ?>/img/v" enctype="multipart/form-data">
                    <label for="nouvimage">Ajouter une nouvelle photo : </label>
                    <input type="file" id="nouvimage" name="nouvimage" accept=".jpg, .jpeg, .png, .gif">
                    <span style="color:red" id="filesizewarning" class="hide">La photo ne doit pas dépasser 2Mo</span>
                    <input type="submit" value="Valider" id="submitform">
                </form>
            </div>
            <?php if (!empty($listePhotos)) :
                foreach ($listePhotos as $photo) : ?>
                    <div class="object">
                        <img src="/public/img/photos/<?= $photo->getNom(); ?>" alt="" class="preview">
                        <?php if ($photo->getCouverture()) : ?>
                            couverture
                        <?php else : ?>
                            <form method="POST" action="<?= URL ?>offres/<?= $bien; ?>/img/c/<?= $photo->getId(); ?>">
                                <button>Choisir comme photo de couverture</button>
                            </form>
                        <?php endif; ?>
                        <form method="POST" action="<?= URL ?>offres/<?= $bien; ?>/img/s/<?= $photo->getId(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer cette image ?');">
                            <button>Supprimer</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="object"><a href="<?= URL ?>offres/<?= $bien; ?>">Retour</a></div>
        </div>
    <?php else : require("permissionError.view.php");
    endif; ?>
</section>
<script src="/scripts/gererPhoto.js"></script>

<?php
$content = ob_get_clean();
$titre = "Gestion de photos";
require "template.php";
