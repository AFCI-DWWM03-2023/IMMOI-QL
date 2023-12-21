<?php

class UtilisateurController{
    private $utilisateurManager;

    public function __construct() {
        require_once "Models/managers/UtilisateurManager.php";
        $this->utilisateurManager = new UtilisateurManager;
        $this->utilisateurManager->chargementUserlist();
    }

    public function afficherUtilisateurs(){
        $DBuser = $this->utilisateurManager->getUserlist();
        require "Views/BD/utilisateurs.view.php";
    }

    public function afficherUtilisateur($id){
        $user = $this->utilisateurManager->getUserById($id);
        require "Views/BD/afficherUtilisateur.view.php";
    }

    public function ajoutUtilisateur(){
        require "Views/inscription.view.php";
    }

    public function ajoutUtilisateurValidation(){
        $this->utilisateurManager->ajoutUtilisateurBD($_POST['username'], $_POST['email'], $_POST['password']);
        header('Location: '.URL."bdtest/utilisateurs");
    }

    public function suppressionUtilisateur($id){
        $this->utilisateurManager->suppressionUtilisateurBD($id);
        header('Location: '.URL."bdtest/utilisateurs");
    }

    public function modifierUtilisateur($id){
        $user = $this->utilisateurManager->getUserById($id);
        require "Views/BD/modifierUtilisateur.view.php";
    }

    public function modifierUtilisateurValidation(){
        $this->utilisateurManager->modifUtilisateurBD($_POST['identifiant'], $_POST['username'], $_POST['password'], $_POST['nom'], $_POST['prenom'], $_POST['telephone'], $_POST['email'], $_POST['idAdresse']);
        header('Location: '.URL."bdtest/utilisateurs");
    }
}