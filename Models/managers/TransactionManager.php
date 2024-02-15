<?php

require_once "Models/data/Transaction.class.php";
require_once "Models/Model.class.php";

class TransactionManager extends BDConnexion{
    private $transactionlist = [];

    public function ajoutTransaction($transaction){
        $this->transactionlist[] = $transaction;
    }

    public function getTransactionlist(){
        return $this->transactionlist;
    }

    public function chargementTransactionlist(){
        $req = $this->getBDD()->prepare('SELECT * FROM transactions');
        $req->execute();
        $listeTransaction = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($listeTransaction as $value){
            $transaction = new Transaction($value['idTransaction'], $value['montant'], $value['dateTransaction'], $value['acheteur'], $value['vendeur'], $value['agent'], $value['idBien']);
            $this->ajoutTransaction($transaction);
        }
    }
    
    public function getTransactionsFromUser($user){
        $listeTransaction = [];
        for ($i = 0; $i < count($this->transactionlist); $i++) {
            if ($this->transactionlist[$i]->getAgent() == $user) {
                $listeTransaction[] = $this->transactionlist[$i];
            }
        }
        return $listeTransaction;
    }

}