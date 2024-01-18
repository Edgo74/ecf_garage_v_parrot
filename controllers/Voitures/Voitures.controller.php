<?php
require_once("controllers/Maincontroller.controller.php");
require_once("models/Voitures/VoitureManager.model.php");

class VoitureController extends MainController
{

    private $voitureManager;

    public function __construct()
    {
        $this->voitureManager = new VoitureManager();
        $this->voitureManager->chargementVoiture();
    }
    public function afficherVoitures()
    {
        $data_page = [
            "page_description" => "Description de la page nos voitures",
            "page_title" => "Nos Voitures",
            "page_javascript" => "voiture.js",
            "page_css" =>  "voitures.css",
            "view" => "views/Voitures/voiture.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public static function generateCarHtml($car)
    {
        require("views/Voitures/generateCar.view.php");
    }

    public function filtre_voiture()
    {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $output = json_encode(['error' => 'CSRF Token Invalid']);
            echo $output;
            return;
        } else {
            $this->voitureManager->filtreVoitureBD();
        }
    }

    public function afficherVoiture($id)
    {
        $voiture = $this->voitureManager->getVoitureById($id);
        $data_page = [
            "page_description" => "page afficher voiture",
            "page_title" => "Afficher une Voiture",
            "voiture" => $voiture,
            "page_css" => "main.css",
            "view" => "views/Voitures/afficherVoiture.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function ajouterVoiture()
    {
        $data_page = [
            "page_description" => " page Ajout voiture",
            "page_title" => "Ajout Voiture",
            "page_css" => "main.css",
            "view" => "views/Voitures/ajoutVoiture.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }


    public function ajouterVoitureValidation()
    {
        $titre = Securite::SecureHTML($_POST["Titre"]);
        $year = Securite::SecureHTML($_POST["year"]);
        $carburant = Securite::SecureHTML($_POST["carburant"]);
        $kilometre = Securite::SecureHTML($_POST["kilometre"]);
        $price = Securite::SecureHTML($_POST["price"]);
        $immatriculation = Securite::SecureHTML($_POST["immatriculation"]);
        $type = Securite::SecureHTML($_POST["type"]);
        $date = Securite::SecureHTML($_POST["date"]);
        $file = $_FILES["image"];
        $repertoire = "public/Assets/images/";
        $nomImageAjoute = Toolbox::ajoutImage($file, $repertoire);
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            Toolbox::ajouterMessageAlerte("vous n'avez pas le droit d envoyer ce formulaire", Toolbox::COULEUR_ROUGE);
        } else {
            $this->voitureManager->AjoutVoitureBD(
                $titre,
                $year,
                $carburant,
                $kilometre,
                $price,
                $nomImageAjoute,
                $immatriculation,
                $type,
                $date
            );

            Toolbox::ajouterMessageAlerte("Ajout Réalisé",  Toolbox::COULEUR_VERTE);
            header("location:" . URL . "Voitures");
        }
    }

    public function modifierVoiture($id)
    {
        $voiture = $this->voitureManager->getVoitureById($id);
        $data_page = [
            "page_description" => " page modification voiture",
            "page_title" => "Modification Voiture",
            "voiture" => $voiture,
            "page_css" => "main.css",
            "view" => "views/Voitures/modifierVoiture.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function modifierVoitureValidation()
    {
        $identifiant = Securite::SecureHTML($_POST["identifiant"]);
        $titre = Securite::SecureHTML($_POST["Titre"]);
        $year = Securite::SecureHTML($_POST["year"]);
        $carburant = Securite::SecureHTML($_POST["carburant"]);
        $kilometre = Securite::SecureHTML($_POST["kilometre"]);
        $price = Securite::SecureHTML($_POST["price"]);
        $immatriculation = Securite::SecureHTML($_POST["immatriculation"]);
        $type = Securite::SecureHTML($_POST["type"]);
        $date = Securite::SecureHTML($_POST["date"]);
        $file = $_FILES["image"];
        $imageActuelle = $this->voitureManager->getVoitureById($identifiant)->getImage();
        $file = $_FILES["image"];
        if ($file["size"] > 0) {
            unlink("public/Assets/images/" . $imageActuelle);
            $repertoire = "public/Assets/images/";
            $nomImageToAdd = Toolbox::ajoutImage($file, $repertoire);
        } else {
            $nomImageToAdd = $imageActuelle;
        }
        $this->voitureManager->modificationVoitureBD(
            $identifiant,
            $titre,
            $year,
            $carburant,
            $kilometre,
            $price,
            $nomImageToAdd,
            $immatriculation,
            $type,
            $date
        );

        Toolbox::ajouterMessageAlerte("Modification Réalisé",  Toolbox::COULEUR_VERTE);
        header("location:" . URL . "Voitures");
    }

    public function supprimerVoiture($id)
    {
        $nomImage = $this->voitureManager->getVoitureById($id)->getImage();
        unlink("public/Assets/images" . $nomImage);
        $this->voitureManager->supprimerVoitureBD($id);

        Toolbox::ajouterMessageAlerte("Suppression Réalisé",  Toolbox::COULEUR_VERTE);
        header("location:" . URL . "Voitures");
    }

    public function pageAdminModifierVoiture()
    {
        $voitures = $this->voitureManager->getVoitures();
        $data_page = [
            "page_description" => "Page de modification/suppression d 'une voiture",
            "page_title" => "Page pour modifier/supprimer une voiture",
            "voitures" => $voitures,
            "page_css" => "disable-button.css",
            "page_javascript" => "pageVoiture.js",
            "view" => "views/Voitures/ModifierSupprimerVoiture.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function modifier_supprimer_voiture()
    {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $output = json_encode(['error' => 'CSRF Token Invalid']);
            echo $output;
            return;
        } else {
            $this->voitureManager->modifier_supprimer_voiture_BD();
        }
    }
}
