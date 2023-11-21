<?php
require_once("controllers/Maincontroller.controller.php");
require_once("models/Avis/AvisManager.model.php");
Class AvisController extends MainController{

    public  $avisManager;

    public function __construct(){
        $this->avisManager = new AvisManager;
        $this->avisManager->chargementAvis();
    }

    function getAvis(){
        $avis = $this->avisManager->getAvis();
        return $avis;
    }

    public function ajouterAvis(){
        $avis = $this->avisManager->getAvis();
        $data_page = [
            "page_description" => " Page d'avis",
            "page_title" => "Avis",
            "avis"=> $avis,
            "page_css" => "style.css",
            "view" => "views/Avis/avis.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }
    public function ajouterAvisValidation(){
        $nom = Securite::SecureHTML($_POST["nom"]);
        $note = Securite::SecureHTML($_POST["note"]);
        $comment = Securite::SecureHTML($_POST["comment"]);
        $valide = 1;
        $nonValide = 0;
        if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            Toolbox::ajouterMessageAlerte("vous n'avez pas le droit d envoyer ce formulaire", Toolbox::COULEUR_ROUGE);
        }else{
            if(!Securite::estConnecte()){
                $this->avisManager->validerAjoutAvisBD($nom,$note,$comment, $nonValide);
            }else{
                $this->avisManager->validerAjoutAvisBD($nom,$note,$comment, $valide);
            }
            Toolbox::ajouterMessageAlerte("Avis Ajouté",  Toolbox::COULEUR_VERTE);
            header("location:".URL ."accueil");
        }
    }
    public function supprimerAvis($id){
        $this->avisManager->supprimeAvisBD($id);
        Toolbox::ajouterMessageAlerte("Avis Supprimé",  Toolbox::COULEUR_VERTE);
        header("location:".URL ."accueil");
    }
    public function validerAvis($id){
        $this->avisManager->validerAvisBD($id);
        Toolbox::ajouterMessageAlerte("Avis Validé",  Toolbox::COULEUR_VERTE);
        header("location:".URL ."accueil");
    }

    public function pageAdminValiderAvis(){
        $avis = $this->avisManager->getAvis();
        $data_page = [
            "page_description" => "Page de modification et de suppression avis",
            "page_title" => "Page pour modifier et supprimer un avis",
            "page_javascript" =>"avisPage.js",
            "avis"=> $avis,
            "page_css" => "style.css",
            "view" => "views/Avis/ValiderSupprimerAvis.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function valider_supprimer_avis(){
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $output = json_encode(['error' => 'CSRF Token Invalid']);
            echo $output;
            return;
        }else{
            $this->avisManager->valider_supprimer_avis_BD();
        }
    }
}