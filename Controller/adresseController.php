<?php

class AdresseController{
    private $adresseManager;

    public function __construct() {
        require_once "Models/managers/AdresseManager.php";
        $this->adresseManager = new AdresseManager;
        $this->adresseManager->chargementAdresselist();
    }

    public function getManager()
    {
        return $this->adresseManager;
    }

    

    public function afficherAdresses(){
        $DBagence = $this->adresseManager->getAdresselist();
        require "Views/BD/adresses.view.php";
    }

    public function getAdresselist(){
        return $this->adresseManager->getAdresselist();
    }

    public function getAdresseSearch(){
        return $this->adresseManager->searchAdresseList($_POST["searchville"]);
    }
    public function getAdresseSearchDpt(){
        return $this->adresseManager->searchAdresseDptList($_POST["dptselect"]);
    }

    public function addAdresse(){
        $this->adresseManager->ajoutAdresseBD($_POST['adresse'], $_POST['zipcode'], $_POST['localite']);
    }

    public function removeOldAdresse(){
        $this->adresseManager->suppressionAdresseBD($_POST["oldadresse"]);
    }
    
    public function suppressionAdresse($id){
        $this->adresseManager->suppressionAdresseBD($id);
    }

}