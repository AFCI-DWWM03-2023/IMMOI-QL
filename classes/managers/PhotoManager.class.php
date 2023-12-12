<?php

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
            $photo = new Photo($value['idPhoto'], $value['nom'], $value['idBien']);
            $this->ajoutPhoto($photo);
        }
    }

}