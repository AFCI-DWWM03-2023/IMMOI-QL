<?php

require_once "Models/data/Utilisateur.class.php";
require_once "Models/Model.class.php";

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
            $user = new Utilisateur($value['idUtilisateur'], $value['username'], $value['password'], $value['nom'], $value['prenom'], $value['telephone'], $value['email'], $value['idAdresse'], $value['estAgent'], $value['agence']);
            $this->ajoutUtilisateur($user);
        }
    }

    public function getUserById($id){
        for ($i=0; $i < count($this->userlist); $i++) {
            if ($this->userlist[$i]->getId() == $id) {
                return $this->userlist[$i];
            }
        }
    }

    public function getUserByUsername($username){
        for ($i=0; $i < count($this->userlist); $i++) {
            if ($this->userlist[$i]->getUsername() == $username) {
                return $this->userlist[$i];
            }
        }
    }

    public function ajoutUtilisateurBD($username, $email, $password, $estAgent, $agence) {
        $req = "INSERT INTO utilisateur(username, password, email, estAgent, agence) VALUES (:username, :password, :email, :estAgent, :agence)";

        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":username", $username, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":estAgent", $estAgent, PDO::PARAM_BOOL);
        $stmt->bindValue(":agence", $agence, PDO::PARAM_INT);
        
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $user = new Utilisateur($this->getBDD()->lastInsertId(), $username, $password, NULL, NULL, NULL, $email, NULL, $estAgent, $agence);
            $this->ajoutUtilisateur($user);
        }
    }

    public function suppressionUtilisateurBD($id){
        $req = "DELETE FROM utilisateur WHERE idUtilisateur = :idUtilisateur";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":idUtilisateur", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $user = $this->getUserById($id);
            unset($user);
        }
    }

    public function verifUtilisateurExiste($username, $email) {
        $res = false;
        $i = 0;
        while (!$res && $i<count($this->userlist)) {
            if ($this->userlist[$i]->getUsername() == $username || $this->userlist[$i]->getUsername() == "admin" || $this->userlist[$i]->getEmail() == $email) $res = true;
            $i++;
        }
        return $res;
    }

    public function connexion($username, $password) {
        $req = "SELECT * FROM utilisateur WHERE username = :username";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":username", $username, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $passwordHash = $this->getUserByUsername($username)->getPassword();
            if (password_verify($password, $passwordHash)) {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // public function modifUtilisateurBD($id, $username, $nom, $prenom, $telephone, $email, $idAdresse) {
    //     $req = "UPDATE utilisateur SET username = :username, nom = :nom, prenom = :prenom, telephone = :telephone, email = :email, idAdresse = :idAdresse WHERE idUtilisateur = :idUtilisateur";
    //     $stmt = $this->getBDD()->prepare($req);
    //     $stmt->bindValue(":idUtilisateur", $id, PDO::PARAM_INT);
    //     $stmt->bindValue(":username", $username, PDO::PARAM_STR);
    //     $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
    //     $stmt->bindValue(":prenom", $prenom, PDO::PARAM_STR);
    //     $stmt->bindValue(":telephone", $telephone, PDO::PARAM_STR);
    //     $stmt->bindValue(":email", $email, PDO::PARAM_STR);
    //     if (empty($idAdresse)) {
    //         $stmt->bindValue(":idAdresse", NULL, PDO::PARAM_INT);
    //     } else { $stmt->bindValue(":idAdresse", $idAdresse, PDO::PARAM_INT); }
        
    //     $resultat = $stmt->execute();
    //     $stmt->closeCursor();

    //     if($resultat > 0){
    //         $this->getUserById($id)->setUsername($username);
    //         $this->getUserById($id)->setPassword($password);
    //         $this->getUserById($id)->setNom($nom);
    //         $this->getUserById($id)->setPrenom($prenom);
    //         $this->getUserById($id)->setTelephone($telephone);
    //         $this->getUserById($id)->setEmail($email);
    //         $this->getUserById($id)->setAdresse($idAdresse);
    //     }
    // }

}