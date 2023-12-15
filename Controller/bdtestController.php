<?php

class BDTestController{

    private $adminManager;
    private $adresseManager;
    private $agenceManager;
    private $agentManager;
    private $bienManager;
    private $transactionManager;
    private $photoManager;
    private $utilisateurManager;

    public function __construct() {
        require_once "Models/managers/AdminManager.php";
        require_once "Models/managers/AdresseManager.php";
        require_once "Models/managers/AgenceManager.php";
        require_once "Models/managers/AgentManager.php";
        require_once "Models/managers/BienManager.php";
        require_once "Models/managers/PhotoManager.php";
        require_once "Models/managers/TransactionManager.php";
        require_once "Models/managers/UtilisateurManager.php";
        $this->adminManager = new AdminManager;                 $this->adminManager->chargementAdminlist();
        $this->adresseManager = new AdresseManager;             $this->adresseManager->chargementAdresselist();
        $this->agenceManager = new AgenceManager;               $this->agenceManager->chargementAgencelist();
        $this->agentManager = new AgentManager;                 $this->agentManager->chargementAgentlist();
        $this->bienManager = new BienManager;                   $this->bienManager->chargementBienlist();
        $this->photoManager = new PhotoManager;                 $this->photoManager->chargementPhotolist();
        $this->transactionManager = new TransactionManager;     $this->transactionManager->chargementTransactionlist();
        $this->utilisateurManager = new UtilisateurManager;     $this->utilisateurManager->chargementUserlist();
    }

    public function afficherDBTest(){
        $DBadmin = $this->adminManager->getAdminlist();
        $DBadresse = $this->adresseManager->getAdresselist();
        $DBagence = $this->agenceManager->getAgencelist();
        $DBagent = $this->agentManager->getAgentlist();
        $DBbien = $this->bienManager->getBienlist();
        $DBphoto = $this->photoManager->getPhotolist();
        $DBtransaction = $this->transactionManager->getTransactionlist();
        $DBuser = $this->utilisateurManager->getUserlist();
        require "Views/bdtest.view.php";
    }

}