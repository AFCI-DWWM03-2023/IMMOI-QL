<?php

require_once "Models/data/Admin.class.php";
require_once "Models/Model.class.php";

class AdminManager extends BDConnexion{
    private $adminlist;

    public function ajoutAdmin($admin){
        $this->adminlist[] = $admin;
    }

    public function getAdminlist(){
        return $this->adminlist;
    }

    public function chargementAdminlist(){
        $req = $this->getBDD()->prepare('SELECT * FROM administrateur');
        $req->execute();
        $listeAdmin = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($listeAdmin as $value){
            $user = new Admin($value['username'], $value['password']);
            $this->ajoutAdmin($user);
        }
    }

}