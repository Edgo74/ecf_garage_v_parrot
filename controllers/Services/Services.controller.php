<?php
require_once("controllers/Maincontroller.controller.php");
require_once("models/Services/ServiceManager.model.php");
require_once("controllers/Avis/Avis.controller.php");
class ServiceController extends MainController
{

    private  $serviceManager;
    private  $avisController;

    public function __construct()
    {
        $this->serviceManager = new ServiceManager;
        $this->serviceManager->chargementService();
        $this->avisController = new AvisController;
    }


    public function accueil()
    {
        $services = $this->serviceManager->getService();
        $avis = $this->avisController->getAvis();
        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "Titre de la page d'accueil",
            "page_css" => "accueil.css",
            "page_javascript" => ["accueil.js"],
            "services" => $services,
            "avis" => $avis,
            "view" => "views/Commons/accueil.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function ajouterService()
    {
        $data_page = [
            "page_description" => "Description de la page Ajout sevice ",
            "page_title" => "Titre de la page Ajout service",
            "page_css" => "disable-button.css",
            "page_javascript" => ["ajoutService.js"],
            "view" => "views/Services/ajoutService.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }


    public function validationAjoutService()
    {
        $titre = Securite::SecureHTML($_POST["Titre"]);
        $description = Securite::SecureHTML($_POST["description"]);
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            Toolbox::ajouterMessageAlerte("vous n'avez pas le droit d envoyer ce formulaire", Toolbox::COULEUR_ROUGE);
        } else {
            $this->serviceManager->AjoutServiceBD($titre, $description);

            Toolbox::ajouterMessageAlerte("Service Ajouté",  Toolbox::COULEUR_VERTE);
            header("location:" . URL . "Services/page_modifier_supprimer_service");
        }
    }

    public function supprimerService($id)
    {
        $this->serviceManager->SupprimeServiceBD($id);

        Toolbox::ajouterMessageAlerte("Service Supprimé",  Toolbox::COULEUR_VERTE);
        header("location:" . URL . "Services/page_modifier_supprimer_service");
    }

    public function modifierService($id)
    {
        $service = $this->serviceManager->getServiceById($id);
        $data_page = [
            "page_description" => "Description de la page modification voiture",
            "page_title" => " page  modification Voiture",
            "service" => $service,
            "page_css" => "main.css",
            "view" => "views/Services/modifierService.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function modifierServiceValidation()
    {
        $titre = Securite::SecureHTML($_POST["Titre"]);
        $description = Securite::SecureHTML($_POST["description"]);
        $identifiant = Securite::SecureHTML($_POST["identifiant"]);
        $this->serviceManager->ModificationServiceBD($titre, $description, $identifiant);

        Toolbox::ajouterMessageAlerte("Service Modifié",  Toolbox::COULEUR_VERTE);
        header("location:" . URL . "Services/page_modifier_supprimer_service");
    }

    public function pageAdminModifierService()
    {
        $services = $this->serviceManager->getService();
        $data_page = [
            "page_description" => "Page de modification service",
            "page_title" => "Page pour modifier un service",
            "services" => $services,
            "page_css" => "disable-button.css",
            "page_javascript" => ["pageService.js", "modifService.js"],
            "view" => "views/Services/ModifierSupprimerService.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function modifier_supprimer_service()
    {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $output = json_encode(['error' => 'CSRF Token Invalid']);
            echo $output;
            return;
        } else {
            $this->serviceManager->modifier_supprimer_service_BD();
        }
    }
}
