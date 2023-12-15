<?php

class Utilisateur{
    public function __construct(private $idUtilisateur, private $username, private $password, private $nom, private $prenom, private $telephone, private $email, private $idAdresse)
    {
    }

    public function getId()               {return $this->idUtilisateur;}
    public function getUsername()         {return $this->username;}
    public function getPassword()         {return $this->password;}
    public function getNom()              {return $this->nom;}
    public function getPrenom()           {return $this->prenom;}
    public function getTelephone()        {return $this->telephone;}
    public function getEmail()            {return $this->email;}
    public function getAdresse()          {return $this->idAdresse;}

    public function setId($idUtilisateur)          {$this->idUtilisateur = $idUtilisateur;}
    public function setUsername($username)         {$this->username = $username;}
    public function setPassword($password)         {$this->password = $password;}
    public function setNom($nom)                   {$this->nom = $nom;}
    public function setPrenom($prenom)             {$this->prenom = $prenom;}
    public function setTelephone($telephone)       {$this->telephone = $telephone;}
    public function setEmail($email)               {$this->email = $email;}
    public function setAdresse($idAdresse)         {$this->idAdresse = $idAdresse;}

}