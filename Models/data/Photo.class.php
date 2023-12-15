<?php

class Photo{
    public function __construct(private $idPhoto, private $nom, private $idBien, private $couverture)
    {
    }

    public function getId()              {return $this->idPhoto;}
    public function getNom()             {return $this->nom;}
    public function getBien()            {return $this->idBien;}
    public function getCouverture()      {return $this->couverture;}

    public function setId($idPhoto)             {$this->idPhoto = $idPhoto;}
    public function setNom($nom)                {$this->nom = $nom;}
    public function setBien($idBien)            {$this->idBien = $idBien;}
    public function setCouverture($couverture)  {$this->couverture = $couverture;}

}