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
require_once "Controller/photoController.php";
$photoController = new PhotoController;
$DBphoto = $photoController->getPhotoList();
require_once "Controller/transactionController.php";
$transactionController = new TransactionController;
$DBtransaction = $transactionController->getTransactionList();

try {
    if (empty($_GET['page'])) {
        header('Location: ' . URL . "accueil");
    } else {
        $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);
        switch ($url[0]) {
            case "accueil":
                $agenceNombre = count($agenceController->getAgenceList());
                $agentsNombre = count($utilisateurController->getAgentsList());
                $caroussel = $photoController->getRandomPhotoCouverture();
                require "Views/accueil.view.php";
                break;
            case "bdtest":
                if (!isset($_SESSION["admin"])) {
                    header('Location: ' . URL . "accueil");
                } else {
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
                    if ($_POST['username'] == "admin" && $_POST['password'] == "root") {
                        $_SESSION["admin"] = true;
                        header('Location: ' . URL . "accueil");
                    } else {
                        $utilisateurController->connexionValidation();
                    }
                }
                break;
            case "deconnexion":
                if (isset($_SESSION["admin"])) {
                    unset($_SESSION["admin"]);
                    header('Location: ' . URL . "accueil");
                } else {
                    $utilisateurController->deconnexion();
                }
                break;
            case "profil":
                if (empty($url[1])) {
                    if (isset($_SESSION['user'])) {
                        $utilisateurController->afficherProfil($_SESSION['user']['id']);
                    } else {
                        header('Location: ' . URL . "connexion");
                    }
                } else {
                    if ($url[1] == "edit") {
                        if (empty($url[2])) {
                            if (isset($_SESSION['connecte'])) {
                                $utilisateurController->modifierProfil();
                            } else {
                                require "Views/BD/modifprofil.view.php";
                            }
                        } else if ($url[2] == "v") {
                            if (isset($_POST['verifmodifprofil'])) {
                                $emailInvalide = 0;
                                if ($_POST['email'] != $_SESSION['user']['email']) {
                                    $emailInvalide = $utilisateurController->verifUtilisateurExiste(null, $_POST['email']);
                                }
                                if ($emailInvalide) {
                                    $_POST["erreuremail"] = true;
                                    $utilisateurController->modifierProfil();
                                } else {
                                    if (isset($_POST["adressemodif"]) & $_POST["adresse"] != "" & $_POST["zipcode"] != "" & $_POST["localite"] != "") {
                                        $adresseController->removeOldAdresse();
                                        $adresseController->addAdresse();
                                    }
                                    $utilisateurController->modifierValidation();
                                }
                            } else {
                                header('Location: ' . URL . "profil/edit");
                            }
                        }
                    } else if ($url[1] == "transactions") {
                        $transactionController->afficherTransactions($_SESSION["user"]["id"]);
                    } else {
                        if (empty($url[2])) {
                            $utilisateurController->afficherProfil($url[1]);
                        } else if ($url[2] == "offres") {
                            if (empty($url[3])) {
                                $bienController->afficherBiensByUser($url[1]);
                            } else if ($url[3] === "s") {
                                $addresseBien = $bienController->getBienById($url[4])->getAdresse();
                                $adresseController->suppressionAdresse($addresseBien);
                                $bienController->suppressionBienUser($url[4]);
                            }
                        }
                    }
                }
                break;
            case "offre":
                if (empty($url[1])) header('Location: ' . URL . "offres");
                else $bienController->afficherBien($url[1]);
                break;
            case "region":
                require "Views/region.view.php";
                break;
            case "offres":
                if (empty($url[1])) {
                    $bienController->afficherOffres();
                } else {
                    if (empty($url[2])) {
                        $bienController->afficherBien($url[1]);
                    } else if ($url[2] == "img") {
                        if (isset($_SESSION["user"]["id"]) && $_SESSION["user"]["id"] == $bienController->getBienById($url[1])->getUtilisateur()) {
                            if (empty($url[3])) {
                                $photoController->gererPhotos($url[1]);
                            } else if ($url[3] == "v") {
                                $photoController->addPhoto($url[1]);
                            } else if ($url[3] == "s") {
                                $photoController->deletePhoto($url[4]);
                            } else if ($url[3] == "c") {
                                $photoController->changePhotoCouv($url[1], $url[4]);
                            }
                        } else {
                            require "Views/permissionError.view.php";
                        }
                    } else if ($url[2] == "modif") {
                        if (isset($_SESSION["user"]["id"]) && $_SESSION["user"]["id"] == $bienController->getBienById($url[1])->getUtilisateur()) {
                            if (empty($url[3])) {
                                $bienController->modificationBien($url[1]);
                            } else if ($url[3] == "validation") {
                                if (isset($_POST['verifmodifbien'])) {
                                    if (isset($_POST["adressemodif"])) {
                                        $adresseController->removeOldAdresse();
                                        $adresseController->addAdresse();
                                    }
                                    $bienController->modifierValidation($url[1]);
                                } else {
                                    header('Location: ' . URL . "offres/" . $url[1]);
                                }
                            }
                        } else {
                            require "Views/permissionError.view.php";
                        }
                    }
                }
                break;
            case "utilisateurs":
                require "Views/BD/utilisateurs.view.php";
                break;
            case "recherche":
                if (isset($_POST['verifsearch'])) {
                    $listeadresses = $adresseController->getAdresseSearch();
                    $bienController->rechercheBien($listeadresses);
                } if (isset($_POST['verifsearchdpt'])) {
                    $listeadresses = $adresseController->getAdresseSearchDpt();
                    $bienController->rechercheBien($listeadresses);
                }
                else {
                    header('Location: ' . URL . "offres");
                }
                break;
            case "publier":
                if (empty($url[1])) {
                    require "Views/publier.view.php";
                } else if ($url[1] === "validation") {
                    if (isset($_POST['verifpublier'])) {
                        $adresseController->addAdresse();
                        $bienController->publierValidation();
                        var_dump($_FILES);
                        if ($_FILES['photocouv']["size"]>0) {$photoController->addPhotoCouv();}
                        header('Location: ' . URL . "offres/" . $_POST['idbien']);
                    } else {
                        header('Location: ' . URL . "accueil");
                    }
                }
                break;

            default:
                throw new Exception("La page n'existe pas");
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
