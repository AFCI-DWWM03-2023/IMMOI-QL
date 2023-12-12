<?php

class AgenceManager extends BDConnexion{
    private $agencelist;

    public function ajoutAgence($agence){
        $this->agencelist[] = $agence;
    }

    public function getAgencelist(){
        return $this->agencelist;
    }

    public function chargementAgencelist(){
        $req = $this->getBDD()->prepare('SELECT * FROM agence');
        $req->execute();
        $listeAgence = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($listeAgence as $value){
            $agence = new Agence($value['idAgence'], $value['nom'], $value['idAdresse']);
            $this->ajoutAgence($agence);
        }
    }

}