<?php

require_once("models/MainManager.model.php");
require("entities/Garage/Garage.class.php");


class GarageManager extends Model
{

    private $garage;

    public function ajoutGarage($infogarage)
    {
        $this->garage[] = $infogarage;
    }

    public function getGarage()
    {
        return $this->garage;
    }


    public function chargementGarage()
    {
        $req = "SELECT * FROM garage";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $garages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        foreach ($garages as $garage) {
            $g = new Garage($garage["garage_id"], $garage["adresse"], $garage["numero"]);
            $this->ajoutGarage($g);
        }
    }
}
