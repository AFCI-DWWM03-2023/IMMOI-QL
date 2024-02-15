<?php

require_once "Models/data/Agence.class.php";
require_once "Models/Model.class.php";

class AgenceManager extends BDConnexion{
    private $agencelist = [];

    public function ajoutAgence($agence){
        $this->agencelist[] = $agence;
    }

    public function getAgencelist(){
        return $this->agencelist;
    }

    public function getAgenceById($id)
    {
        for ($i = 0; $i < count($this->agencelist); $i++) {
            if ($this->agencelist[$i]->getId() == $id) {
                return $this->agencelist[$i];
            }
        }
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