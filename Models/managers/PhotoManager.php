<?php

require_once "Models/data/Photo.class.php";
require_once "Models/Model.class.php";

class PhotoManager extends BDConnexion{
    private $photolist;

    public function ajoutPhoto($photo){
        $this->photolist[] = $photo;
    }

    public function getPhotolist(){
        return $this->photolist;
    }

    public function getPhotoCouverturelist(){
        $photocouverturelist = [];
        foreach ($this->photolist as $value) {
            if ($value->getCouverture())
            $photocouverturelist[] = $value;
        }
        return $photocouverturelist;
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
        if (isset($this->photolist)) {
            for ($i = 0; $i < count($this->photolist); $i++) {
                if ($this->photolist[$i]->getBien() == $id) {
                    $listePhotos[] = $this->photolist[$i];
                }
            }
        }
        return $listePhotos;
    }

    public function getCouvertureFromBien($id){
        if (isset($this->photolist)) {
            for ($i = 0; $i < count($this->photolist); $i++) {
                if ($this->photolist[$i]->getBien() == $id && $this->photolist[$i]->getCouverture()) {
                    return $this->photolist[$i];
                }
            }
        }
        return false;
    }

    public function ajoutPhotoBD($nom, $couverture, $idBien)
    {
        $req = "INSERT INTO photo(nom, couverture, idBien) VALUES (:nom, :couverture, :idBien)";

        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":couverture", $couverture, PDO::PARAM_BOOL);
        $stmt->bindValue(":idBien", $idBien, PDO::PARAM_INT);

        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if ($resultat > 0) {
            $photo = new Photo($this->getBDD()->lastInsertId(), $nom, $couverture, $idBien);
            $this->ajoutPhoto($photo);
            $_POST['idphoto'] = $this->getBDD()->lastInsertId();
        }
    }
    
    public function getPhotoById($id)
    {
        for ($i = 0; $i < count($this->photolist); $i++) {
            if ($this->photolist[$i]->getId() == $id) {
                return $this->photolist[$i];
            }
        }
    }
    
    public function suppressionPhotoBD($id)
    {
        $req = "DELETE FROM photo WHERE idPhoto = :idPhoto";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":idPhoto", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if ($resultat > 0) {
            $photo = $this->getPhotoById($id);
            unset($photo);
        }
    }

    public function modifierCouvertureBD($id, $couverture)
    {
        $req = "UPDATE photo SET couverture = :couverture WHERE idPhoto = :idPhoto";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":idPhoto", $id, PDO::PARAM_INT);
        $stmt->bindValue(":couverture", $couverture, PDO::PARAM_BOOL);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if ($resultat > 0) {
            $this->getPhotoById($id)->setCouverture($couverture);
        }
    }
}