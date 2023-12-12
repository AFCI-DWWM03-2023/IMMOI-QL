<?php

require_once "classes/Model.class.php";
require_once "classes/managers/UtilisateurManager.class.php";
require_once "classes/managers/AdresseManager.class.php";
require_once "classes/managers/AdminManager.class.php";
require_once "classes/managers/AgenceManager.class.php";
require_once "classes/managers/AgentManager.class.php";
require_once "classes/managers/BienManager.class.php";
require_once "classes/managers/TransactionManager.class.php";
require_once "classes/managers/PhotoManager.class.php";
require_once "classes/data/Utilisateur.class.php";
require_once "classes/data/Adresse.class.php";
require_once "classes/data/Admin.class.php";
require_once "classes/data/Agence.class.php";
require_once "classes/data/Agent.class.php";
require_once "classes/data/Bien.class.php";
require_once "classes/data/Transaction.class.php";
require_once "classes/data/Photo.class.php";

$utilisateurManager = new UtilisateurManager;
$utilisateurManager->chargementUserlist();
$adresseManager = new AdresseManager;
$adresseManager->chargementAdresselist();
$agenceManager = new AgenceManager;
$agenceManager->chargementAgencelist();
$agentManager = new AgentManager;
$agentManager->chargementAgentlist();
$bienManager = new BienManager;
$bienManager->chargementBienlist();
$transactionManager = new TransactionManager;
$transactionManager->chargementTransactionlist();
$adminManager = new AdminManager;
$adminManager->chargementAdminlist();
$photoManager = new PhotoManager;
$photoManager->chargementPhotolist();

ob_start(); ?>

<section class="testbdd">

    <h2>Admin</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>Password</th>
        </tr>
        <?php
        $admin = $adminManager->getAdminlist();
        for ($i = 0; $i < count($admin); $i++) : ?>
            <tr>
                <td><?= $admin[$i]->getUsername(); ?></td>
                <td><?= $admin[$i]->getPassword(); ?></td>
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
        $user = $utilisateurManager->getUserlist();
        for ($i = 0; $i < count($user); $i++) : ?>
            <tr>
                <td><?= $user[$i]->getId(); ?></td>
                <td><?= $user[$i]->getUsername(); ?></td>
                <td><?= $user[$i]->getPassword(); ?></td>
                <td><?= $user[$i]->getNom(); ?></td>
                <td><?= $user[$i]->getPrenom(); ?></td>
                <td><?= $user[$i]->getTelephone(); ?></td>
                <td><?= $user[$i]->getEmail(); ?></td>
                <td><?= $user[$i]->getAdresse(); ?></td>
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
        $adresse = $adresseManager->getAdresselist();
        for ($i = 0; $i < count($adresse); $i++) : ?>
            <tr>
                <td><?= $adresse[$i]->getId(); ?></td>
                <td><?= $adresse[$i]->getNomVoie(); ?></td>
                <td><?= $adresse[$i]->getZipcode(); ?></td>
                <td><?= $adresse[$i]->getLocalite(); ?></td>
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
        $agence = $agenceManager->getAgencelist();
        for ($i = 0; $i < count($agence); $i++) : 
            $adresseagence = $adresse[$agence[$i]->getAdresse()-1];?>
            <tr>
                <td><?= $agence[$i]->getId(); ?></td>
                <td><?= "Agence " . $agence[$i]->getNom(); ?></td>
                <td><?= $agence[$i]->getAdresse(); ?></td>
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
        $agent = $agentManager->getAgentlist();
        for ($i = 0; $i < count($agent); $i++) : ?>
            <tr>
                <td><?= $agent[$i]->getId(); ?></td>
                <td><?= $agent[$i]->getUsername(); ?></td>
                <td><?= $agent[$i]->getPassword(); ?></td>
                <td><?= $agent[$i]->getNom(); ?></td>
                <td><?= $agent[$i]->getPrenom(); ?></td>
                <td><?= "Agence " . $agence[$agent[$i]->getIdAgence()-1]->getNom(); ?></td>
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
        $bien = $bienManager->getBienlist();
        for ($i = 0; $i < count($bien); $i++) : ?>
            <tr>
                <td><?= $bien[$i]->getId(); ?></td>
                <td><?= $bien[$i]->getNom(); ?></td>
                <td><?= $bien[$i]->getDescription(); ?></td>
                <td><?= $bien[$i]->getPrixLoc(). "€/mois"; ?></td>
                <td><?= $bien[$i]->getPrixVente(). "€"; ?></td>
                <td><?= $bien[$i]->getCategorie(); ?></td>
                <td><?= $bien[$i]->getNbPieces(); ?></td>
                <td><?= $bien[$i]->getNbEtages(); ?></td>
                <td><?= $bien[$i]->getSurface()."m²"; ?></td>
                <td><?= $bien[$i]->getNumAppart(); ?></td>
                <td><?= $bien[$i]->getUtilisateur(); ?></td>
                <td><?= $bien[$i]->getAdresse(); ?></td>
            </tr>
        <?php endfor; ?>
    </table>
    <h2>Photos</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>ID bien</th>
        </tr>
        <?php
        $photo = $photoManager->getPhotolist();
        for ($i = 0; $i < count($photo); $i++) : ?>
            <tr>
                <td><?= $photo[$i]->getId(); ?></td>
                <td><?= $photo[$i]->getNom(); ?></td>
                <td><?= $photo[$i]->getBien(); ?></td>
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
        $transaction = $transactionManager->getTransactionlist();
        for ($i = 0; $i < count($transaction); $i++) : ?>
            <tr>
                <td><?= $transaction[$i]->getId(); ?></td>
                <td><?= $transaction[$i]->getAgent(); ?></td>
                <td><?= $transaction[$i]->getBien(); ?></td>
                <td><?= $transaction[$i]->getDate(); ?></td>
                <td><?= $transaction[$i]->getMontant()."€"; ?></td>
            </tr>
        <?php endfor; ?>
    </table>

</section>

<?php
$content = ob_get_clean();
$titre = "Tests Base de Données";
require "template.php";
