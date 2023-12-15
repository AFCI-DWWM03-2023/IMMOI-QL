<?php

class OffresController{

    private $adresseManager;
    private $bienManager;
    private $photoManager;

    public function __construct() {
        require_once "Models/managers/AdresseManager.php";
        require_once "Models/managers/BienManager.php";
        require_once "Models/managers/PhotoManager.php";
        $this->adresseManager = new AdresseManager;             $this->adresseManager->chargementAdresselist();
        $this->bienManager = new BienManager;                   $this->bienManager->chargementBienlist();
        $this->photoManager = new PhotoManager;                 $this->photoManager->chargementPhotolist();
    }

    public function afficherOffres(){
        $DBadresse = $this->adresseManager->getAdresselist();
        $DBbien = $this->bienManager->getBienlist();
        $DBphoto = $this->photoManager->getPhotolist();
        require "Views/offres.view.php";
    }

}