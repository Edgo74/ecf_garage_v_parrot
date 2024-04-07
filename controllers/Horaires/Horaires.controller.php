<?php
require_once("controllers/Maincontroller.controller.php");
require_once("models/Horaires/HorairesManager.model.php");
class HorairesController extends MainController
{

    private  $horaireManager;


    public function __construct()
    {
        $this->horaireManager = new HoraireManager;
        $this->horaireManager->chargementHoraires();
    }

    public function getHoraires()
    {
        $horaires = $this->horaireManager->getHoraires();
        return $horaires;
    }

    public function modifierHoraires()
    {
        $horaires = $this->horaireManager->getHoraires();
        $data_page = [
            "page_description" => "Description de la page modification Horaires",
            "page_title" => " page  modification Horaires",
            "horaires" => $horaires,
            "page_javascript" => ["pageHoraires.js"],
            "view" => "views/Horaires/modifierHoraires.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function modifierHorairesValidation()
    {
        $id = Securite::SecureHTML($_POST["horaire_id"]);
        $statut = Securite::SecureHTML($_POST["statut"]);
        $debutAM = Securite::SecureHTML($_POST["debutAM"]);
        $finAM = Securite::SecureHTML($_POST["finAM"]);
        $debutPM = Securite::SecureHTML($_POST["debutPM"]);
        $finPM = Securite::SecureHTML($_POST["finPM"]);
        $this->horaireManager->ModifierHorairesBD($id, $statut, $debutAM, $finAM, $debutPM, $finPM);
        Toolbox::ajouterMessageAlerte("Horaires Modifié",  Toolbox::COULEUR_VERTE);
        header("location:" . URL . "Horaires/modifierHoraires");
    }


    public function modifierLesHoraires()
    {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $output = json_encode(['error' => 'CSRF Token Invalid']);
            echo $output;
            return;
        } else {
            $this->horaireManager->selectionnerUnJourBD();
        }
    }
}
