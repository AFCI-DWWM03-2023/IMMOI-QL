<?php ob_start(); ?>

<section class="content">
    <section class="testbdd">
        <h2>Utilisateurs</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>ID adresse</th>
                <th>Actions</th>
            </tr>
            <?php
            for ($i = 0; $i < count($DBuser); $i++) : ?>
                <tr>
                    <td><?= $DBuser[$i]->getId(); ?></td>
                    <td><?= $DBuser[$i]->getUsername(); ?></td>
                    <td><?= $DBuser[$i]->getPassword(); ?></td>
                    <td><?= $DBuser[$i]->getNom(); ?></td>
                    <td><?= $DBuser[$i]->getPrenom(); ?></td>
                    <td><?= $DBuser[$i]->getTelephone(); ?></td>
                    <td><?= $DBuser[$i]->getEmail(); ?></td>
                    <td><?= $DBuser[$i]->getAdresse(); ?></td>
                    <td>
                        <a href="<?= URL ?>bdtest/utilisateurs/m/<?= $DBuser[$i]->getId(); ?>"><button>Modifier</button></a>
                        <form method="POST" action="<?= URL ?>bdtest/utilisateurs/s/<?= $DBuser[$i]->getId(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">
                            <button class="supprimer">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endfor; ?>
        </table>
    </section>
</section>

<?php
$content = ob_get_clean();
$titre = "Tests Base de Données";
require "Views/template.php";
