<?php ob_start(); ?>

<section class="content">
    <section class="testbdd">
        <h2>Biens</h2>
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
                <th>Publié par</th>
                <th>Adresse</th>
                <th>Supprimer</th>
            </tr>
            <?php
            if ($DBbien !== NULL) :
            for ($i = 0; $i < count($DBbien); $i++) : ?>
                <tr>
                    <td><?= $DBbien[$i]->getId(); ?></td>
                    <td><?= $DBbien[$i]->getNom(); ?></td>
                    <td><?= $DBbien[$i]->getDescription() ?></td>
                    <td><?= $DBbien[$i]->getPrixLoc() ?></td>
                    <td><?= $DBbien[$i]->getPrixVente() ?></td>
                    <td><?= $DBbien[$i]->getCategorie() ?></td>
                    <td><?= $DBbien[$i]->getNbPieces() ?></td>
                    <td><?= $DBbien[$i]->getNbEtages() ?></td>
                    <td><?= $DBbien[$i]->getSurface() ?></td>
                    <td><?= $DBbien[$i]->getNumAppart() ?></td>
                    <td><?= $DBuser[$DBbien[$i]->getUtilisateur()-1]->getUsername() ?></td>
                    <td><?= $DBadresse[$DBbien[$i]->getAdresse()-1]->getNomVoie() . " " . $DBadresse[$DBbien[$i]->getAdresse()-1]->getZipcode() . " " . $DBadresse[$DBbien[$i]->getAdresse()-1]->getLocalite()?></td>
                    <td>
                        <form method="POST" action="<?= URL ?>bdtest/biens/s/<?= $DBbien[$i]->getId(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer cette annonce ?');">
                    <button class="supprimer">Supprimer</button>
                </form></td>
                </tr>
            <?php endfor; endif;?>
        </table>
    </section>
</section>

<?php
$content = ob_get_clean();
$titre = "Tests Base de Données";
require "Views/template.php";
