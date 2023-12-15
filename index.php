<?php

require_once "Controller/bdtestController.php";
$bdtestController = new BDTestController;

if(empty($_GET['page'])){
    require "Views/accueil.view.php";
}else{
    switch($_GET['page']){
        case "accueil" : require "Views/accueil.view.php"; break;
        case "bdtest" : $bdtestController->afficherDBTest(); break;
        case "inscription" : require "Views/inscription.view.php"; break;
        case "region" : require "Views/region.view.php"; break;
    }
}