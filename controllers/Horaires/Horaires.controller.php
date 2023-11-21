<?php
require_once("controllers/Maincontroller.controller.php");
require_once("models/Horaires/HorairesManager.model.php");
Class HorairesController extends MainController{

    private  $horaireManager;


    public function __construct(){
        $this->horaireManager = new HoraireManager;
        $this->horaireManager->chargementHoraires();
    }

    public function getHoraires(){
        $horaires = $this->horaireManager->getHoraires();
        return $horaires;
    }

    public function modifierHoraires(){
        $horaires = $this->horaireManager->getHoraires();
        $data_page = [
            "page_description" => "Description de la page modification Horaires",
            "page_title" => " page  modification Horaires",
            "horaires" => $horaires,
            "page_javascript" => "horaires.js",
            "view" => "views/Horaires/modifierHoraires.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function modifierHorairesValidation(){
        $heures = $_POST["hours"];
        foreach($heures as $index=> $heure){
            $debutHeure_AM = $heure['debutHeure_AM'];
            $finHeure_AM = $heure['finHeure_AM'];
            $debutHeure_PM = $heure['finHeure_PM'];
            $finHeure_PM = $heure['finHeure_PM'];
            $status = $heure['status'];
            if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                Toolbox::ajouterMessageAlerte("vous n'avez pas le droit d envoyer ce formulaire", Toolbox::COULEUR_ROUGE);
            }else{
                $this->horaireManager->ModifierHorairesBD($index, $debutHeure_AM, $finHeure_AM, $debutHeure_PM, $finHeure_PM, $status);
            }
        }
        Toolbox::ajouterMessageAlerte("Horaires Modifié",  Toolbox::COULEUR_VERTE);
        header("location:" .URL. "administrateur/administration");
    }

}