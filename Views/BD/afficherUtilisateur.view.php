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
            </tr>
            <tr>
                <td><?= $user->getId(); ?></td>
                <td><?= $user->getUsername(); ?></td>
                <td><?= $user->getPassword(); ?></td>
                <td><?= $user->getNom(); ?></td>
                <td><?= $user->getPrenom(); ?></td>
                <td><?= $user->getTelephone(); ?></td>
                <td><?= $user->getEmail(); ?></td>
                <td><?= $user->getAdresse(); ?></td>
            </tr>
        </table>
    </section>
</section>

<?php
$content = ob_get_clean();
$titre = "Tests Base de Données";
require "Views/template.php";
