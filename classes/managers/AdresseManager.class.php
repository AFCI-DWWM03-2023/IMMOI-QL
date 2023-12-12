<?php

class AdresseManager extends BDConnexion{
    private $adresselist;

    public function ajoutAdresse($adresse){
        $this->adresselist[] = $adresse;
    }

    public function getAdresselist(){
        return $this->adresselist;
    }

    public function chargementAdresselist(){
        $req = $this->getBDD()->prepare('SELECT * FROM adresse');
        $req->execute();
        $listeAdresse = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($listeAdresse as $value){
            $adresse = new Adresse($value['idAdresse'], $value['nomVoie'], $value['zipcode'], $value['localite']);
            $this->ajoutAdresse($adresse);
        }
    }

}