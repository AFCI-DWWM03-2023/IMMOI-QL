<?php

class BienController
{
    private $bienManager;

    public function __construct()
    {
        require_once "Models/managers/BienManager.php";
        $this->bienManager = new BienManager;
        $this->bienManager->chargementBienlist();
    }

    public function getBienList()
    {
        return $this->bienManager->getBienlist();
    }

    public function afficherOffres(){
        $listebiens = $this->bienManager->getBienlist();
        require "Views/offres.view.php";
    }

    public function afficherBien($id)
    {
        $bien = $this->bienManager->getBienById($id);
        if (isset($bien)) {
            require "Views/BD/bien.view.php";
        } else {
            require "Views/BD/bienError.view.php";
        }
    }

    public function afficherBiensByUser($id)
    {
        $listebien = $this->bienManager->getBiensFromUser($id);
        if (count($listebien) !== 0) {
            require "Views/BD/bienUser.view.php";
        } else {
            require "Views/BD/bienUserError.view.php";
        }
    }

    public function rechercheBien($listeadresses) {
        $listebiens = $this->bienManager->getBienRecherche($_POST["searchcategorie"], $listeadresses, $_POST["searchventeloc"], $_POST["searchprix"]);
        if (count($listebiens) !== 0) {
            require "Views/offres.view.php";
        } else {
            require "Views/offresError.view.php";
        }
    }

    public function modificationBien($id)
    {
        $bien = $this->bienManager->getBienById($id);
        require "Views/modifBien.view.php";
    }
    
    public function modifierValidation($id)
    {
        if (!isset($_POST['idadresse'])) $_POST['idadresse'] = $this->bienManager->getBienById($id)->getAdresse();
        $this->bienManager->modifierBienBD($id, $_POST['nom'], $_POST['desc'], ($_POST['venteloc'] == "loc") ? $_POST["prix"] : NULL, ($_POST['venteloc'] == "vente") ? $_POST["prix"] : NULL, $_POST["categorie"], $_POST["nbpieces"], $_POST["nbetages"], $_POST["surface"], $_POST["numappart"], $_POST["idadresse"]);
        header('Location: ' . URL . "offres/" . $id);
    }

    public function publierValidation()
    {
        $this->bienManager->ajoutBienBD($_POST['nom'], $_POST['desc'], ($_POST['venteloc'] == "loc") ? $_POST["prix"] : NULL, ($_POST['venteloc'] == "vente") ? $_POST["prix"] : NULL, $_POST["categorie"], $_POST["nbpieces"], $_POST["nbetages"], $_POST["surface"], $_POST["numappart"], $_SESSION['user']['id'], $_POST["idadresse"]);
        header('Location: ' . URL . "offres/" . $_POST['idbien']);
    }
    
    public function suppressionBien($id){
        $this->bienManager->suppressionBienBD($id);
        header('Location: '.URL."bdtest/biens");
    }
    
    public function suppressionBienUser($id){
        $utilisateur = $this->bienManager->getBienById($id)->getUtilisateur();
        $this->bienManager->suppressionBienBD($id);
        header('Location: '.URL."profil/".$utilisateur."/offres");
    }
}
