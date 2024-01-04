<?php

class Transaction{
    public function __construct(private $idTransaction, private $montant, private $dateTransaction, private $acheteur, private $vendeur, private $agent, private $idBien)
    {
    }

    public function getId()              {return $this->idTransaction;}
    public function getMontant()         {return $this->montant;}
    public function getDate()            {return $this->dateTransaction;}
    public function getAcheteur()        {return $this->acheteur;}
    public function getVendeur()         {return $this->vendeur;}
    public function getAgent()           {return $this->agent;}
    public function getBien()            {return $this->idBien;}

    public function setId($idTransaction)         {$this->idTransaction = $idTransaction;}
    public function setMontant($montant)          {$this->montant = $montant;}
    public function setDate($dateTransaction)     {$this->dateTransaction = $dateTransaction;}
    public function setAcheteur($acheteur)        {$this->acheteur = $acheteur;}
    public function setVendeur($vendeur)          {$this->vendeur = $vendeur;}
    public function setAgent($agent)              {$this->agent = $agent;}
    public function setBien($idBien)              {$this->idBien = $idBien;}

}