<?php

require_once "Models/data/Adresse.class.php";
require_once "Models/Model.class.php";

class AdresseManager extends BDConnexion
{
    private $adresselist;

    public function ajoutAdresse($adresse)
    {
        $this->adresselist[] = $adresse;
    }

    public function getAdresselist()
    {
        return $this->adresselist;
    }

    public function searchAdresseList($ville){
        $listeAdresse = [];
        foreach ($this->adresselist as $value) {
            if ($ville == "" || strtolower($value->getLocalite()) == strtolower($ville)) {
                $listeAdresse[] = $value->getId();
            }
        }
        return $listeAdresse;
    }

    public function chargementAdresselist()
    {
        $req = $this->getBDD()->prepare('SELECT * FROM adresse');
        $req->execute();
        $listeAdresse = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach ($listeAdresse as $value) {
            $adresse = new Adresse($value['idAdresse'], $value['nomVoie'], $value['zipcode'], $value['localite']);
            $this->ajoutAdresse($adresse);
        }
    }

    public function ajoutAdresseBD($nomVoie, $zipcode, $localite)
    {
        $req = "INSERT INTO adresse(nomVoie, zipcode, localite) VALUES (:nomVoie, :zipcode, :localite)";

        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":nomVoie", $nomVoie, PDO::PARAM_STR);
        $stmt->bindValue(":zipcode", $zipcode, PDO::PARAM_STR);
        $stmt->bindValue(":localite", $localite, PDO::PARAM_STR);

        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if ($resultat > 0) {
            $adresse = new Adresse($this->getBDD()->lastInsertId(), $nomVoie, $zipcode, $localite);
            $this->ajoutAdresse($adresse);
            $_POST['idadresse'] = $this->getBDD()->lastInsertId();
        }
    }
}
