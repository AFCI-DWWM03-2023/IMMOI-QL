<?php ob_start(); ?>

<section class="testbdd">

    <h2>Admin</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>Password</th>
        </tr>
        <?php
        for ($i = 0; $i < count($DBadmin); $i++) : ?>
            <tr>
                <td><?= $DBadmin[$i]->getUsername(); ?></td>
                <td><?= $DBadmin[$i]->getPassword(); ?></td>
            </tr>
        <?php endfor; ?>
    </table>
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
            </tr>
        <?php endfor; ?>
    </table>
    <h2>Adresses</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom de voie</th>
            <th>Code postal</th>
            <th>Localité</th>
        </tr>
        <?php
        for ($i = 0; $i < count($DBadresse); $i++) : ?>
            <tr>
                <td><?= $DBadresse[$i]->getId(); ?></td>
                <td><?= $DBadresse[$i]->getNomVoie(); ?></td>
                <td><?= $DBadresse[$i]->getZipcode(); ?></td>
                <td><?= $DBadresse[$i]->getLocalite(); ?></td>
            </tr>
        <?php endfor; ?>
    </table>
    <h2>Agences</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>ID adresse</th>
            <th>Adresse</th>
        </tr>
        <?php
        for ($i = 0; $i < count($DBagence); $i++) : 
            $adresseagence = $DBadresse[$DBagence[$i]->getAdresse()-1];?>
            <tr>
                <td><?= $DBagence[$i]->getId(); ?></td>
                <td><?= "Agence " . $DBagence[$i]->getNom(); ?></td>
                <td><?= $DBagence[$i]->getAdresse(); ?></td>
                <td><?= $adresseagence->getNomVoie() ." - ". $adresseagence->getZipcode() . " " .  $adresseagence->getLocalite(); ?></td>
            </tr>
        <?php endfor; ?>
    </table>
    <h2>Agents</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Agence</th>
        </tr>
        <?php
        for ($i = 0; $i < count($DBagent); $i++) : ?>
            <tr>
                <td><?= $DBagent[$i]->getId(); ?></td>
                <td><?= $DBagent[$i]->getUsername(); ?></td>
                <td><?= $DBagent[$i]->getPassword(); ?></td>
                <td><?= $DBagent[$i]->getNom(); ?></td>
                <td><?= $DBagent[$i]->getPrenom(); ?></td>
                <td><?= "Agence " . $DBagence[$DBagent[$i]->getIdAgence()-1]->getNom(); ?></td>
            </tr>
        <?php endfor; ?>
    </table>
    <h2>Biens</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix de location</th>
            <th>Prix de vente</th>
            <th>Catégorie</th>
            <th>Pièces</th>
            <th>Etages</th>
            <th>Surface</th>
            <th>Numéro appartement</th>
            <th>ID utilisateur</th>
            <th>ID adresse</th>
        </tr>
        <?php
        for ($i = 0; $i < count($DBbien); $i++) : ?>
            <tr>
                <td><?= $DBbien[$i]->getId(); ?></td>
                <td><?= $DBbien[$i]->getNom(); ?></td>
                <td><?= $DBbien[$i]->getDescription(); ?></td>
                <td><?= ($DBbien[$i]->getPrixLoc()) ? $DBbien[$i]->getPrixLoc(). "€/mois" : null; ?></td>
                <td><?= ($DBbien[$i]->getPrixVente()) ? $DBbien[$i]->getPrixVente(). "€" : null; ?></td>
                <td><?= $DBbien[$i]->getCategorie(); ?></td>
                <td><?= $DBbien[$i]->getNbPieces(); ?></td>
                <td><?= $DBbien[$i]->getNbEtages(); ?></td>
                <td><?= $DBbien[$i]->getSurface()."m²"; ?></td>
                <td><?= $DBbien[$i]->getNumAppart(); ?></td>
                <td><?= $DBbien[$i]->getUtilisateur(); ?></td>
                <td><?= $DBbien[$i]->getAdresse(); ?></td>
            </tr>
        <?php endfor; ?>
    </table>
    <h2>Photos</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>ID bien</th>
            <th>Photo de couverture</th>
        </tr>
        <?php
        for ($i = 0; $i < count($DBphoto); $i++) : ?>
            <tr>
                <td><?= $DBphoto[$i]->getId(); ?></td>
                <td><?= $DBphoto[$i]->getNom(); ?></td>
                <td><?= $DBphoto[$i]->getBien(); ?></td>
                <td><?= ($DBphoto[$i]->getCouverture()) ? "oui" : "non"; ?></td>
            </tr>
        <?php endfor; ?>
    </table>
    <h2>Transactions</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>ID agent</th>
            <th>ID bien</th>
            <th>Date</th>
            <th>Montant</th>
        </tr>
        <?php
        for ($i = 0; $i < count($DBtransaction); $i++) : ?>
            <tr>
                <td><?= $DBtransaction[$i]->getId(); ?></td>
                <td><?= $DBtransaction[$i]->getAgent(); ?></td>
                <td><?= $DBtransaction[$i]->getBien(); ?></td>
                <td><?= $DBtransaction[$i]->getDate(); ?></td>
                <td><?= $DBtransaction[$i]->getMontant()."€"; ?></td>
            </tr>
        <?php endfor; ?>
    </table>

</section>

<?php
$content = ob_get_clean();
$titre = "Tests Base de Données";
require "template.php";
