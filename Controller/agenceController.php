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

    // public function afficherUtilisateur($id){
    //     $user = $this->utilisateurManager->getUserById($id);
    //     require "Views/BD/afficherUtilisateur.view.php";
    // }

    // public function inscription(){
    //     require "Views/inscription.view.php";
    // }

    // public function inscriptionValidation(){
    //     $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    //     $this->utilisateurManager->ajoutUtilisateurBD($_POST['username'], $_POST['email'], $password, false, NULL);
    //     header('Location: '.URL."bdtest/utilisateurs");
    // }

    // public function suppressionUtilisateur($id){
    //     $this->utilisateurManager->suppressionUtilisateurBD($id);
    //     header('Location: '.URL."bdtest/utilisateurs");
    // }

    // public function modifierUtilisateur($id){
    //     $user = $this->utilisateurManager->getUserById($id);
    //     require "Views/BD/modifierUtilisateur.view.php";
    // }

    // public function modifierUtilisateurValidation(){
    //     $this->utilisateurManager->modifUtilisateurBD($_POST['identifiant'], $_POST['username'], $_POST['password'], $_POST['nom'], $_POST['prenom'], $_POST['telephone'], $_POST['email'], $_POST['idAdresse']);
    //     header('Location: '.URL."bdtest/utilisateurs");
    // }
}