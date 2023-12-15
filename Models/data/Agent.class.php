<?php

class Agent{
    public function __construct(private $idAgent, private $username, private $password, private $nom, private $prenom, private $idAgence)
    {
    }

    public function getId()               {return $this->idAgent;}
    public function getUsername()         {return $this->username;}
    public function getPassword()         {return $this->password;}
    public function getNom()              {return $this->nom;}
    public function getPrenom()           {return $this->prenom;}
    public function getIdAgence()         {return $this->idAgence;}

    public function setId($idAgent)                {$this->idAgent = $idAgent;}
    public function setUsername($username)         {$this->username = $username;}
    public function setPassword($password)         {$this->password = $password;}
    public function setNom($nom)                   {$this->nom = $nom;}
    public function setPrenom($prenom)             {$this->prenom = $prenom;}
    public function setIdAgence($idAgence)         {$this->idAgence = $idAgence;}

}