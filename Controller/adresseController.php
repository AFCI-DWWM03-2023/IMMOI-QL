<?php

class AdresseController{
    private $adresseManager;

    public function __construct() {
        require_once "Models/managers/AdresseManager.php";
        $this->adresseManager = new AdresseManager;
        $this->adresseManager->chargementAdresselist();
    }

    public function afficherAdresses(){
        $DBagence = $this->adresseManager->getAdresselist();
        require "Views/BD/adresses.view.php";
    }

    public function getAdresselist(){
        return $this->adresseManager->getAdresselist();
    }

    public function addAdresse(){
        $this->adresseManager->ajoutAdresseBD($_POST['adresse'], $_POST['zipcode'], $_POST['localite']);
    }

}