<?php

class UtilisateurManager extends BDConnexion{
    private $userlist;

    public function ajoutUtilisateur($utilisateur){
        $this->userlist[] = $utilisateur;
    }

    public function getUserlist(){
        return $this->userlist;
    }

    public function chargementUserlist(){
        $req = $this->getBDD()->prepare('SELECT * FROM utilisateur');
        $req->execute();
        $listeUtilisateur = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($listeUtilisateur as $value){
            $user = new Utilisateur($value['idUtilisateur'], $value['username'], $value['password'], $value['nom'], $value['prenom'], $value['telephone'], $value['email'], $value['idAdresse']);
            $this->ajoutUtilisateur($user);
        }
    }

}