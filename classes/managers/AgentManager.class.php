<?php

class AgentManager extends BDConnexion{
    private $agentlist;

    public function ajoutUtilisateur($agent){
        $this->agentlist[] = $agent;
    }

    public function getAgentlist(){
        return $this->agentlist;
    }

    public function chargementAgentlist(){
        $req = $this->getBDD()->prepare('SELECT * FROM agent');
        $req->execute();
        $listeAgent = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($listeAgent as $value){
            $agent = new Agent($value['idAgent'], $value['username'], $value['password'], $value['nom'], $value['prenom'], $value['idAgence']);
            $this->ajoutUtilisateur($agent);
        }
    }

}