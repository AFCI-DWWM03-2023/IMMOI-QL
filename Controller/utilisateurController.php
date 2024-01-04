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

    public function inscription(){
        require "Views/inscription.view.php";
    }

    public function inscriptionValidation(){
        if ($this->utilisateurManager->verifUtilisateurExiste($_POST['username'], $_POST['email'])) {
            header('Location: '.URL."inscription/retry");
        } else {
            $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
            $this->utilisateurManager->ajoutUtilisateurBD($_POST['username'], $_POST['email'], $password, $_POST['estAgent'], ($_POST['estAgent']) ? $_POST['agence'] : NULL);
            header('Location: '.URL."bdtest/utilisateurs");
        }
    }

    public function connexion(){
        require "Views/connexion.view.php";
    }

    public function connexionValidation(){
        $res = $this->utilisateurManager->connexion($_POST['username'], $_POST['password']);
        if ($res) {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['connecte'] = true;
            header('Location: '.URL."accueil");
        } else {
            header('Location: '.URL."connexion/retry");
        }
    }

    public function suppressionUtilisateur($id){
        $this->utilisateurManager->suppressionUtilisateurBD($id);
        header('Location: '.URL."bdtest/utilisateurs");
    }

    // public function modifierUtilisateur($id){
    //     $user = $this->utilisateurManager->getUserById($id);
    //     require "Views/BD/modifierUtilisateur.view.php";
    // }

    // public function modifierUtilisateurValidation(){
    //     $this->utilisateurManager->modifUtilisateurBD($_POST['identifiant'], $_POST['username'], $_POST['password'], $_POST['nom'], $_POST['prenom'], $_POST['telephone'], $_POST['email'], $_POST['idAdresse']);
    //     header('Location: '.URL."bdtest/utilisateurs");
    // }
}