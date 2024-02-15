<?php

class TransactionController{
    private $transactionManager;

    public function __construct() {
        require_once "Models/managers/TransactionManager.php";
        $this->transactionManager = new TransactionManager;
        $this->transactionManager->chargementTransactionlist();
    }

    public function afficherTransactions($id){
        $transactionList = $this->transactionManager->getTransactionsFromUser($id);
        require "Views/BD/transactions.view.php";
    }

    public function getTransactionList(){
        return $this->transactionManager->getTransactionlist();
    }

}