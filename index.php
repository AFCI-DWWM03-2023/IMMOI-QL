<?php

session_start();
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once "Controller/utilisateurController.php";
$utilisateurController = new UtilisateurController;
require_once "Controller/offresController.php";
$offresController = new OffresController;
require_once "Controller/agenceController.php";
$agenceController = new AgenceController;

try {
    if (empty($_GET['page'])) {
        require "Views/accueil.view.php";
    } else {
        $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);
        switch ($url[0]) {
            case "accueil":
                require "Views/accueil.view.php";
                break;
            case "bdtest":
                if (empty($url[1])) require "Views/bdtest.view.php";
                else {
                    switch ($url[1]) {
                        case "utilisateurs":
                            if (empty($url[2])) {
                                $utilisateurController->afficherUtilisateurs();
                            } else if ($url[2] === "s") {
                                $utilisateurController->suppressionUtilisateur($url[3]);
                            }
                            break;
                    }
                }
                break;
            case "inscription":
                if (empty($url[1]) || $url[1] === "retry") {
                    if (!empty($url[1]) && $url[1] === "retry") $_POST['userExiste'] = true;
                    $_POST['DBagence'] = $agenceController->getAgenceList();
                    $utilisateurController->inscription();
                } else if ($url[1] === "validation") {
                    $utilisateurController->inscriptionValidation();
                }
                break;
            case "connexion":
                if (empty($url[1]) || $url[1] === "retry") {
                    if (!empty($url[1]) && $url[1] === "retry") $_POST['connexionEchoue'] = true;
                    $utilisateurController->connexion();
                } else if ($url[1] === "validation") {
                    $utilisateurController->connexionValidation();
                }
                break;
            case "deconnexion":
                $utilisateurController->deconnexion();
                break;
            case "profil":
                if (empty($url[1])) $utilisateurController->afficherProfil($_SESSION['user']['id']);
                else $utilisateurController->afficherProfil($url[1]);
                break;
            case "region":
                require "Views/region.view.php";
                break;
            case "offres":
                $offresController->afficherOffres();
                break;
            case "utilisateurs":
                require "Views/BD/utilisateurs.view.php";
                break;
            default:
                throw new Exception("La page n'existe pas");
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
