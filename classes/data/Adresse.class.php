<?php

class Adresse{
    public function __construct(private $idAdresse, private $nomVoie, private $zipcode, private $localite)
    {
    }

    public function getId()              {return $this->idAdresse;}
    public function getNomVoie()         {return $this->nomVoie;}
    public function getZipcode()         {return $this->zipcode;}
    public function getLocalite()        {return $this->localite;}

    public function setId($idAdresse)            {$this->idAdresse = $idAdresse;}
    public function setNomVoie($nomVoie)         {$this->nomVoie = $nomVoie;}
    public function setZipcode($zipcode)         {$this->zipcode = $zipcode;}
    public function setLocalite($localite)       {$this->localite = $localite;}

}