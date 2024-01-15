<?php

session_start();
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once "Controller/utilisateurController.php";
$utilisateurController = new UtilisateurController;
$DBuser = $utilisateurController->getUtilisateursList();
require_once "Controller/bienController.php";
$bienController = new BienController;
$DBbien = $bienController->getBienList();
require_once "Controller/agenceController.php";
$agenceController = new AgenceController;
$DBagence = $agenceController->getAgenceList();
require_once "Controller/adresseController.php";
$adresseController = new AdresseController;
$DBadresse = $adresseController->getAdresseList();

try {
    if (empty($_GET['page'])) {
        require "Views/accueil.view.php";
    } else {
        $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);
        switch ($url[0]) {
            case "accueil":
                $agenceNombre = count($agenceController->getAgenceList());
                require "Views/accueil.view.php";
                break;
            case "bdtest":
                if (empty($url[1])) require "Views/bdtest.view.php";
                else {
                    switch ($url[1]) {
                        case "utilisateurs":
                            if (empty($url[2])) {
                                require "Views/BD/utilisateurs.view.php";
                            } else if ($url[2] === "s") {
                                $utilisateurController->suppressionUtilisateur($url[3]);
                            }
                            break;
                        case "biens":
                            if (empty($url[2])) {
                                require "Views/BD/biens.view.php";
                            } else if ($url[2] === "s") {
                                $bienController->suppressionBien($url[3]);
                            }
                            break;
                    }
                }
                break;
            case "inscription":
                if (empty($url[1]) || $url[1] === "retry") {
                    if (!empty($url[1]) && $url[1] === "retry") $_POST['userExiste'] = true;
                    require "Views/inscription.view.php";
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
                // case "offres":
                //     $biensController->afficherBiens();
                //     break;
            case "utilisateurs":
                require "Views/BD/utilisateurs.view.php";
                break;
            case "publier":
                if (empty($url[1])) {
                    require "Views/publier.view.php";
                } else if ($url[1] === "validation") {
                    $adresseController->addAdresse();
                    $bienController->publierValidation();
                }
                break;

            default:
                throw new Exception("La page n'existe pas");
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
