<?php

class Bien{
    public function __construct(private $idBien, private $nom, private $description, private $prixLocation, private $prixVente, private $categorie, private $nbPieces, private $nbEtages, private $surface, private $numAppart, private $idUtilisateur, private $idAdresse)
    {
    }

    public function getId()                 {return $this->idBien;}
    public function getNom()                {return $this->nom;}
    public function getDescription()        {return $this->description;}
    public function getPrixLoc()            {return $this->prixLocation;}
    public function getPrixVente()          {return $this->prixVente;}
    public function getCategorie()          {return $this->categorie;}
    public function getNbPieces()           {return $this->nbPieces;}
    public function getNbEtages()           {return $this->nbEtages;}
    public function getSurface()            {return $this->surface;}
    public function getNumAppart()          {return $this->numAppart;}
    public function getUtilisateur()        {return $this->idUtilisateur;}
    public function getAdresse()            {return $this->idAdresse;}

    public function setId($idBien)                      {$this->idBien = $idBien;}
    public function setNom($nom)                        {$this->nom = $nom;}
    public function setDescription($description)        {$this->description = $description;}
    public function setPrixLoc($prixLocation)           {$this->prixLocation = $prixLocation;}
    public function setPrixVente($prixVente)            {$this->prixVente = $prixVente;}
    public function setCategorie($categorie)            {$this->categorie = $categorie;}
    public function setNbPieces($nbPieces)              {$this->nbPieces = $nbPieces;}
    public function setNbEtages($nbEtages)              {$this->nbEtages = $nbEtages;}
    public function setSurface($surface)                {$this->surface = $surface;}
    public function setNumAppart($numAppart)            {$this->numAppart = $numAppart;}
    public function setUtilisateur($idUtilisateur)      {$this->idUtilisateur = $idUtilisateur;}
    public function setAdresse($idAdresse)              {$this->idAdresse = $idAdresse;}

}