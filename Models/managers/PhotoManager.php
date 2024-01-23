<?php

require_once "Models/data/Photo.class.php";
require_once "Models/Model.class.php";

class PhotoManager extends BDConnexion{
    private $photolist;

    public function ajoutPhoto($agence){
        $this->photolist[] = $agence;
    }

    public function getPhotolist(){
        return $this->photolist;
    }

    public function chargementPhotolist(){
        $req = $this->getBDD()->prepare('SELECT * FROM photo');
        $req->execute();
        $listePhoto = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($listePhoto as $value){
            $photo = new Photo($value['idPhoto'], $value['nom'], $value['idBien'], $value['couverture']);
            $this->ajoutPhoto($photo);
        }
    }
    
    public function getPhotosFromBien($id){
        $listePhotos = [];
        for ($i = 0; $i < count($this->photolist); $i++) {
            if ($this->photolist[$i]->getBien() == $id) {
                $listePhotos[] = $this->photolist[$i];
            }
        }
        return $listePhotos;
    }

}