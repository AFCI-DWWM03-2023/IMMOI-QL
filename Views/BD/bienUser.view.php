<?php ob_start();
$url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);
$monprofil = (isset($_SESSION["user"]) && $_SESSION["user"]["id"] == $url[1]) ? true : false;
require_once "Controller/adresseController.php";
$adresseController = new AdresseController;
$DBadresse = $adresseController->getAdresseList();
?>

<section class="content">
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix de location</th>
            <th>Prix de vente</th>
            <th>Catégorie</th>
            <th>Nb. de pièces</th>
            <th>Nb. d'étages</th>
            <th>Surface</th>
            <th>Numéro d'appartement</th>
            <th>Adresse</th>
            <?php if ($monprofil) : ?>
                <th>Actions</th>
            <?php endif; ?>
        </tr>
        <?php foreach ($listebien as $bien) : ?>
            <tr>
                <td><?= $bien->getId(); ?></td>
                <td><?= $bien->getNom(); ?></td>
                <td><?= $bien->getDescription() ?></td>
                <td><?= $bien->getPrixLoc() ?></td>
                <td><?= $bien->getPrixVente() ?></td>
                <td><?= $bien->getCategorie() ?></td>
                <td><?= $bien->getNbPieces() ?></td>
                <td><?= $bien->getNbEtages() ?></td>
                <td><?= $bien->getSurface() ?></td>
                <td><?= $bien->getNumAppart() ?></td>
                <td><?= $DBadresse[$bien->getAdresse() - 1]->getNomVoie() . " " . $DBadresse[$bien->getAdresse() - 1]->getZipcode() . " " . $DBadresse[$bien->getAdresse() - 1]->getLocalite(); ?></td>
                <?php if ($monprofil) : ?>
                    <td>
                        <form method="POST" action="<?= URL ?>profil/<?=$url[1]?>/offres/s/<?= $bien->getId(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer cette annonce ?');">
                            <button class="supprimer">Supprimer</button>
                        </form>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</section>

<?php
$content = ob_get_clean();
$titre = "Bien";
require "Views/template.php";
