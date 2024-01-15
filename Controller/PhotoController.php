<?php

class PhotoController{
    private $photoManager;

    public function __construct() {
        require_once "Models/managers/PhotoManager.php";
        $this->photoManager = new PhotoManager;
        $this->photoManager->chargementPhotolist();
    }

    public function afficherPhotos(){
        $DBbien = $this->photoManager->getPhotolist();
        require "Views/BD/agences.view.php";
    }

    public function getPhotoList(){
        return $this->photoManager->getPhotolist();
    }
}