<?php

class BienManager extends BDConnexion{
    private $bienlist;

    public function ajoutBien($bien){
        $this->bienlist[] = $bien;
    }

    public function getBienlist(){
        return $this->bienlist;
    }

    public function chargementBienlist(){
        $req = $this->getBDD()->prepare('SELECT * FROM bien');
        $req->execute();
        $listeBien = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($listeBien as $value){
            $bien = new Bien($value['idBien'], $value['nom'], $value['description'], $value['prixLocation'], $value['prixVente'], $value['categorie'], $value['nbPieces'], $value['nbEtages'], $value['surface'], $value['numAppart'], $value['idUtilisateur'], $value['idAdresse'] );
            $this->ajoutBien($bien);
        }
    }

}