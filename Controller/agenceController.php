<?php

class AgenceController{
    private $agenceManager;

    public function __construct() {
        require_once "Models/managers/AgenceManager.php";
        $this->agenceManager = new AgenceManager;
        $this->agenceManager->chargementAgencelist();
    }

    public function afficherAgences(){
        $DBagence = $this->agenceManager->getAgencelist();
        require "Views/BD/agences.view.php";
    }

    public function getAgenceList(){
        return $this->agenceManager->getAgencelist();
    }

}