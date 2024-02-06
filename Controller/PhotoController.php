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

    public function getPhotoCouvertureList(){
        return $this->photoManager->getPhotoCouverturelist();
    }

    public function getRandomPhotoCouverture(){
        $list = $this->photoManager->getPhotoCouverturelist();
        shuffle($list);
        if (count($list)>=3) {
            return array_slice($list, 0, 3);
        }
        else {
            return $list;
        }
    }
    
    public function getPhotosByBien($id)
    {
        return $this->photoManager->getPhotosFromBien($id);
    }

    public function addPhotoCouv(){
        $file = $_FILES["photocouv"];
        $repertoire = "public/img/photos/";
        $nomImageAjoutee = $this->ajoutImage($file, $repertoire);
        $this->photoManager->ajoutPhotoBD($nomImageAjoutee, 1, $_POST['idbien']);
    }

    public function addPhotoMult() {
        foreach ($_FILES["photos"] as $file) {
            $repertoire = "public/img/photos/";
            $nomImageAjoutee = $this->ajoutImage($file, $repertoire);
            $this->photoManager->ajoutPhotoBD($nomImageAjoutee, 0, $_POST['idbien']);
        }
    }
    
    private function ajoutImage($file, $dir){
        if(!file_exists($dir)) mkdir($dir,0777);
        
        $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
        do {
            $random = rand(0,99999);
            $target_file = $dir.$random."_".$file['name'];
        } while (file_exists($target_file));
        
        if(!getimagesize($file["tmp_name"]))
            throw new Exception("Le fichier n'est pas une image");
        if(!move_uploaded_file($file['tmp_name'], $target_file))
            throw new Exception("l'ajout de l'image n'a pas fonctionné");
        else return ($random."_".$file['name']);
    }
}