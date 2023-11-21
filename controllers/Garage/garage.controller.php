<?php
require_once("controllers/Maincontroller.controller.php");
require_once("models/Garage/GarageManager.model.php");
Class GarageController extends MainController{

    private  $garageManager;

    public function __construct(){
        $this->garageManager = new GarageManager;
        $this->garageManager->chargementGarage();
    }

    public function getGarage(){
        $garage = $this->garageManager->getGarage();
        return $garage;
    }

}
