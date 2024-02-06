<?php

require_once "Models/data/Bien.class.php";
require_once "Models/Model.class.php";

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

    public function getBienRecherche($scategorie, $listeville, $sventeloc, $sprix){
        $listeBien = [];
        for ($i = 0; $i < count($this->bienlist); $i++) {
            $cond4 = false;
            foreach ($listeville as $adresse) {
                if ($this->bienlist[$i]->getAdresse() == $adresse) $cond4 = true;
            }
            $categorie = $this->bienlist[$i]->getCategorie();
            $venteloc = ($this->bienlist[$i]->getPrixVente() != 0) ? "vente" : "loc";
            $prix = ($this->bienlist[$i]->getPrixVente() != 0) ? $this->bienlist[$i]->getPrixVente() : $this->bienlist[$i]->getPrixLoc();
            $cond1 = ($scategorie == "all" || $scategorie == $categorie);
            $cond2 = ($sventeloc == "venteloc" || $sventeloc == $venteloc);
            $cond3 = ($sprix == "" || $sprix >= $prix);
            if ($cond1 && $cond2 && $cond3 && $cond4) {
                $listeBien[] = $this->bienlist[$i];
            }
        }
        return $listeBien;
    }

    public function getBiensFromUser($user){
        $listeBien = [];
        for ($i = 0; $i < count($this->bienlist); $i++) {
            if ($this->bienlist[$i]->getUtilisateur() == $user) {
                $listeBien[] = $this->bienlist[$i];
            }
        }
        return $listeBien;
    }
    
    public function getBienById($id)
    {
        for ($i = 0; $i < count($this->bienlist); $i++) {
            if ($this->bienlist[$i]->getId() == $id) {
                return $this->bienlist[$i];
            }
        }
    }
    
    public function ajoutBienBD($nom, $description, $prixLocation, $prixVente, $categorie, $nbPieces, $nbEtages, $surface, $numAppart, $idUtilisateur, $idAdresse)
    {
        $req = "INSERT INTO bien(nom, description, prixLocation, prixVente, categorie, nbPieces, nbEtages, surface, numAppart, idUtilisateur, idAdresse) VALUES (:nom, :description, :prixLocation, :prixVente, :categorie, :nbPieces, :nbEtages, :surface, :numAppart, :idUtilisateur, :idAdresse)";

        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":description", $description, PDO::PARAM_STR);
        $stmt->bindValue(":prixLocation", $prixLocation, PDO::PARAM_STR);
        $stmt->bindValue(":prixVente", $prixVente, PDO::PARAM_STR);
        $stmt->bindValue(":categorie", $categorie, PDO::PARAM_STR);
        $stmt->bindValue(":nbPieces", $nbPieces, PDO::PARAM_INT);
        $stmt->bindValue(":nbEtages", $nbEtages, PDO::PARAM_INT);
        $stmt->bindValue(":surface", $surface, PDO::PARAM_INT);
        $stmt->bindValue(":numAppart", $numAppart, PDO::PARAM_INT);
        $stmt->bindValue(":idUtilisateur", $idUtilisateur, PDO::PARAM_INT);
        $stmt->bindValue(":idAdresse", $idAdresse, PDO::PARAM_INT);

        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if ($resultat > 0) {
            $bien = new Bien($this->getBDD()->lastInsertId(), $nom, $description, $prixLocation, $prixVente, $categorie, $nbPieces, $nbEtages, $surface, $numAppart, $idUtilisateur, $idAdresse);
            $this->ajoutBien($bien);
            $_POST['idbien'] = $this->getBDD()->lastInsertId();
        }
    }

    public function suppressionBienBD($id)
    {
        $req = "DELETE FROM bien WHERE idBien = :idBien";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":idBien", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if ($resultat > 0) {
            $bien = $this->getBienById($id);
            unset($bien);
        }
    }



}