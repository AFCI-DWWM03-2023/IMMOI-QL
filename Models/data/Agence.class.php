<?php

class Agence{
    public function __construct(private $idAgence, private $nom, private $idAdresse)
    {
    }

    public function getId()              {return $this->idAgence;}
    public function getNom()             {return $this->nom;}
    public function getAdresse()         {return $this->idAdresse;}

    public function setId($idAgence)            {$this->idAgence = $idAgence;}
    public function setNomVoie($nom)            {$this->nom = $nom;}
    public function setAdresse($idAdresse)      {$this->idAdresse = $idAdresse;}

}