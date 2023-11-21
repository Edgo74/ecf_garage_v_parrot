
<?php

require_once("controllers/Maincontroller.controller.php");
require_once("models/Utilisateur/Utilisateur.model.php");

 Class UtilisateurController extends MainController{

    private $utilisateurManager;

    public function __construct(){
        $this->utilisateurManager = new UtilisateurManager();
    }
    public function login(){
        $data_page = [
            "page_description" => "page de login",
            "page_title" => "page de login",
            "page_css" => "login.css",
            "view" => "views/Utilisateur/login.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function validation_login($email, $password){
        if($this->utilisateurManager->isCombinaisonValide($email, $password) && 
        isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']){

            Toolbox::ajouterMessageAlerte("Bon retour sur le site !", Toolbox::COULEUR_VERTE);
            $_SESSION["profil"] = [
                "login" => $email
            ];
            Securite::genererCookieConnexion();
          header("location:". URL. "compte/page_gestion_employe");
        }else{
            Toolbox::ajouterMessageAlerte("Combinaison Login/Mot de passe invalide", Toolbox::COULEUR_ROUGE);
            header("location:". URL. "login");
        }
    }


    public function deconnexion(){
        Toolbox::ajouterMessageAlerte("La deconnexion est effectuée",Toolbox::COULEUR_VERTE);
        unset($_SESSION['profil']);
        setcookie(Securite::COOKIE_NAME,"",time() - 3600);
        header("Location:".URL."accueil");
    }

    public function administration(){
        $data_page = [
            "page_description" => "Page d'admin",
            "page_title" => "Page d'administration du site",
            "page_css" => "style.css",
            "view" => "views/Utilisateur/admin.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function page_gestion_employe(){
        $datas = $this->utilisateurManager->getUserInformation($_SESSION["profil"]["login"]);
        $_SESSION["profil"]["role"] = $datas["role"];
        $data_page = [
            "page_description" => "Page de gestion pour les employé",
            "page_title" => "Page de gestion des employés",
            "utilisateur" => $datas,
            "page_css" => "style.css",
            "view" => "views/Utilisateur/employe.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function generateEmploye(){
        $data_page = [
            "page_description" => "Page pour créer un compte employé",
            "page_title" => "Génerer un compte employé",
            "page_css" => "admin.css",
            "view" => "views/Utilisateur/generateEmploye.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function validGenerationEmploye(){
        $employe_password = Securite::SecureHTML($_POST["employe_password"]);
        $employe_mail = Securite::SecureHTML($_POST["employe_mail"]);
        $passwordSecure = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,}$/";
        if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            Toolbox::ajouterMessageAlerte("vous n'avez pas le droit d envoyer ce formulaire", Toolbox::COULEUR_ROUGE);
        }elseif (!preg_match($passwordSecure, $employe_password)) {
            Toolbox::ajouterMessageAlerte("Le mot de passe doit contenir au moins 10 caractères, au moins un minuscule, un majuscule et un caractère spécial.", Toolbox::COULEUR_ROUGE);
            header("location:". URL ."administrateur/generer_compte_employe");
        }else{
            $this->utilisateurManager->validationCreationCompteEmploye( $employe_password,  $employe_mail);
            Toolbox::ajouterMessageAlerte("Création de compte effectué avec succes", Toolbox::COULEUR_VERTE);
            header("location:". URL.  "administrateur/generer_compte_employe");
        }
    }


 }


 

