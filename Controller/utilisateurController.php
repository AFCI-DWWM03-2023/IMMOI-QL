<?php

class UtilisateurController
{
    private $utilisateurManager;

    public function __construct()
    {
        require_once "Models/managers/UtilisateurManager.php";
        $this->utilisateurManager = new UtilisateurManager;
        $this->utilisateurManager->chargementUserlist();
    }

    public function getManager()
    {
        return $this->utilisateurManager;
    }

    public function getUtilisateursList()
    {
        return $this->utilisateurManager->getUserlist();
    }

    public function getAgentsList()
    {
        $list = $this->utilisateurManager->getUserlist();
        foreach ($list as $key => $value) {
            if ($value->getEstAgent() == NULL) {
                unset($list[$key]);
            }
        }
        return $list;
    }


    public function afficherProfil($id)
    {
        $user = $this->utilisateurManager->getUserById($id);
        if (isset($user)) {
            require "Views/BD/profil.view.php";
        } else {
            require "Views/BD/profilError.view.php";
        }
    }

    public function modifierProfil()
    {
        $user = $this->utilisateurManager->getUserById($_SESSION['user']['id']);
        if (isset($user)) {
            require "Views/BD/modifprofil.view.php";
        }
    }

    public function modifierValidation()
    {
        $user = $this->utilisateurManager->getUserById($_SESSION['user']['id']);
        if (!isset($_POST['idadresse'])) $_POST['idadresse'] = 0;
        $this->utilisateurManager->modifierProfil($user->getId(), $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['telephone'], $_POST['idadresse']);
        $_SESSION['user'] = [
            "id" => $user->getId(),
            "username" => $user->getUsername(),
            "nom" => $user->getNom(),
            "prenom" => $user->getPrenom(),
            "telephone" => $user->getTelephone(),
            "email" => $user->getEmail(),
            "adresse" => $user->getAdresse(),
            "estAgent" => $user->getEstAgent(),
            "agence" => $user->getAgence()
        ];
        header('Location: ' . URL . "profil");
    }

    public function inscriptionValidation()
    {
        if (isset($_POST["verifinscription"])) {
            if ($this->utilisateurManager->verifUtilisateurExiste($_POST['username'], $_POST['email'])) {
                header('Location: ' . URL . "inscription/retry");
            } else {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $this->utilisateurManager->ajoutUtilisateurBD($_POST['username'], $_POST['email'], $password, $_POST['estAgent'], ($_POST['estAgent']) ? $_POST['agence'] : NULL);
                $this->connexionValidation();
                header('Location: ' . URL . "profil");
            }
        } else {
            header('Location: '.URL."inscription/retry");
        }
    }

    public function connexion()
    {
        require "Views/connexion.view.php";
    }

    public function connexionValidation()
    {
        $res = $this->utilisateurManager->connexion($_POST['username'], $_POST['password']);
        if ($res) {
            $user = $this->utilisateurManager->getUserByUsername($_POST['username']);
            $_SESSION['user'] = [
                "id" => $user->getId(),
                "username" => $user->getUsername(),
                "nom" => $user->getNom(),
                "prenom" => $user->getPrenom(),
                "telephone" => $user->getTelephone(),
                "email" => $user->getEmail(),
                "adresse" => $user->getAdresse(),
                "estAgent" => $user->getEstAgent(),
                "agence" => $user->getAgence()
            ];
            $_SESSION['connecte'] = true;
            header('Location: ' . URL . "accueil");
        } else {
            header('Location: ' . URL . "connexion/retry");
        }
    }

    public function deconnexion()
    {
        unset($_SESSION['user']);
        unset($_SESSION['connecte']);
        header('Location: ' . URL . "accueil");
    }

    public function suppressionUtilisateur($id)
    {
        $this->utilisateurManager->suppressionUtilisateurBD($id);
        header('Location: ' . URL . "bdtest/utilisateurs");
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
