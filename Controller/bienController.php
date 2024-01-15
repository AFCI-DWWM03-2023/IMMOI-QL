<?php

class BienController
{
    private $bienManager;

    public function __construct()
    {
        require_once "Models/managers/BienManager.php";
        $this->bienManager = new BienManager;
        $this->bienManager->chargementBienlist();
    }

    public function getBienList()
    {
        return $this->bienManager->getBienlist();
    }

    public function afficherBien($id)
    {
        $bien = $this->bienManager->getBienById($id);
        if (isset($bien)) {
            require "Views/BD/bien.view.php";
        } else {
            require "Views/BD/bienError.view.php";
        }
    }

    public function publierValidation()
    {
        $this->bienManager->ajoutBienBD($_POST['nom'], $_POST['desc'], ($_POST['venteloc'] == "vente") ? $_POST["prix"] : NULL, ($_POST['venteloc'] == "loc") ? $_POST["prix"] : NULL, $_POST["categorie"], $_POST["nbpieces"], $_POST["nbetages"], $_POST["surface"], $_POST["numappart"], $_SESSION['user']['id'], $_POST["idadresse"]);
    }
}
