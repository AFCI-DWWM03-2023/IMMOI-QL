<?php

session_start();
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once "Controller/bdtestController.php";
$bdtestController = new BDTestController;
require_once "Controller/utilisateurController.php";
$utilisateurController = new UtilisateurController;
require_once "Controller/offresController.php";
$offresController = new OffresController;

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
                if (empty($url[1])) require "Views/bdtestNew.view.php";
                else {
                    switch ($url[1]) {
                        case "utilisateurs":
                            if (empty($url[2])) $utilisateurController->afficherUtilisateurs();
                            else {
                                switch ($url[2]) {
                                    case "l":
                                        $utilisateurController->afficherUtilisateur($url[3]);
                                        break;
                                    case "a":
                                        //$utilisateurController->ajoutUtilisateur();
                                        echo "ajout utilisateur";
                                        break;
                                    case "m":
                                        $utilisateurController->modifierUtilisateur($url[3]);
                                        break;
                                    case "mv":
                                        $utilisateurController->modifierUtilisateurValidation($url[3]);
                                        break;
                                    case "s" :
                                        $utilisateurController->suppressionUtilisateur($url[3]);
                                        break;
                                }
                            }
                            break;
                    }
                }
                //$bdtestController->afficherBDTest();
                break;
            case "inscription":
                if (empty($url[1])) {
                    $utilisateurController->ajoutUtilisateur();
                } else if ($url[1] === "validation") {
                    $utilisateurController->ajoutUtilisateurValidation();
                }
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
