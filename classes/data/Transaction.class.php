<?php

class Transaction{
    public function __construct(private $idTransaction, private $idAgent, private $idBien, private $dateTransaction, private $montant)
    {
    }

    public function getId()              {return $this->idTransaction;}
    public function getAgent()           {return $this->idAgent;}
    public function getBien()            {return $this->idBien;}
    public function getDate()            {return $this->dateTransaction;}
    public function getMontant()         {return $this->montant;}

    public function setId($idTransaction)         {$this->idTransaction = $idTransaction;}
    public function setAgent($idAgent)            {$this->idAgent = $idAgent;}
    public function setBien($idBien)              {$this->idBien = $idBien;}
    public function setDate($dateTransaction)     {$this->dateTransaction = $dateTransaction;}
    public function setMontant($montant)          {$this->montant = $montant;}

}