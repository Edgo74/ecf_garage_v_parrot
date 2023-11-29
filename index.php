<?php
session_start();

require_once("./controllers/Toolbox.class.php");
require_once("./controllers/Securite.class.php");
require_once("controllers/Maincontroller.controller.php");
require_once("controllers/Voitures/Voitures.controller.php");
require_once("controllers/Utilisateur/Utilisateur.controller.php");
require_once("controllers/Contact/Contact.controller.php");
require_once("controllers/Services/Services.controller.php");
require_once("controllers/Horaires/Horaires.controller.php");

$mainController = new MainController();
$voitureController = new VoitureController();
$utilisateurController = new UtilisateurController();
$contactController = new  ContactController();
$serviceController = new  ServiceController();
$horaireController = new HorairesController();
$avisController = new AvisController();

define("URL", str_replace("index.php","","https".
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

try {
    if(empty($_GET["page"])){
        $page = "accueil";
    }else{
        $url = explode("/", filter_var($_GET["page"], FILTER_SANITIZE_URL));
        $page = $url[0];
    }
    
    switch($page){
        case "accueil":$serviceController->accueil();
            break;
        case "Voitures":
            if(empty($url[1])){
                $voitureController->afficherVoitures();
            }else if($url[1] === "afficherVoiture"){
                $voitureController->afficherVoiture($url[2]);
            }else if($url[1] === "ajoutVoiture"){
                Securite::verifierConnexion();
                $voitureController->ajouterVoiture();
            }else if($url[1] === "modifierVoiture"){
                Securite::verifierConnexion();
                $voitureController->modifierVoiture($url[2]);
            }else if($url[1] === "supprimerVoiture"){
               Securite::verifierConnexion();
                $voitureController->supprimerVoiture($url[2]);
            }else if($url[1] === "ValidationAjoutVoiture"){
              Securite::verifierConnexion();
                $voitureController->ajouterVoitureValidation();
            }else if($url[1] === "ValidationModifVoiture"){
              Securite::verifierConnexion();
                $voitureController->modifierVoitureValidation();
            }else if($url[1] === "filtre_voiture"){
                $voitureController->filtre_voiture();
            }else if($url[1] === "page_modifier_supprimer_voiture"){
               Securite::verifierConnexion();
                $voitureController->pageAdminModifierVoiture();
            }else if($url[1] === "modifier_supprimer_voiture"){
             Securite::verifierConnexion();
                $voitureController->modifier_supprimer_voiture();
            }
            break;

        case "Services":
            if(empty($url[1])){
                $serviceController->accueil();
            }else if($url[1] === "ajouterService"){
                Securite::verifierConnexionAdmin();
                $serviceController->ajouterService();
            }else if($url[1] === "modifierService"){
                Securite::verifierConnexionAdmin();
                $serviceController->modifierService($url[2]);
            }else if($url[1] === "supprimerService"){
                Securite::verifierConnexionAdmin();
                $serviceController->supprimerService($url[2]);
            }else if($url[1] === "ValidationAjoutService"){
                Securite::verifierConnexionAdmin();
                $serviceController->validationAjoutService();
            }else if($url[1] === "ValidationModifService"){
                Securite::verifierConnexionAdmin();
                $serviceController->modifierServiceValidation();
            }else if($url[1] === "page_modifier_supprimer_service"){
                Securite::verifierConnexionAdmin();
                $serviceController->pageAdminModifierService();
            }else if($url[1] ===  "modifier_supprimer_service"){
                Securite::verifierConnexionAdmin();
                $serviceController->modifier_supprimer_service();
            }
            break;

        case "Horaires":
            if(empty($url[1])){
                $serviceController->accueil();
                Securite::verifierConnexionAdmin();
            }else if($url[1] === "modifierHoraires"){
                $horaireController->modifierHoraires();
            }else if($url[1] === "modifierHorairesValidation"){
                Securite::verifierConnexionAdmin();
                $horaireController->modifierHorairesValidation();
            }
            break;

        case "Avis":
            if(empty($url[1])){
                $serviceController ->accueil();
            }else if($url[1] === "ajouterAvis"){
                $avisController ->ajouterAvis();
            }else if($url[1] === "supprimerAvis"){
                Securite::verifierConnexion();
                $avisController->supprimerAvis($url[2]);
            }else if($url[1] === "ajoutAvisValidation"){
                $avisController->ajouterAvisValidation();
            }else if($url[1] === "validerAvis"){
                Securite::verifierConnexion();
                $avisController->validerAvis($url[2]);
            }else if($url[1] === "page_valider_supprimer_avis"){
                Securite::verifierConnexion();
                $avisController->pageAdminValiderAvis();
            }else if($url[1] === "valider_supprimer_avis"){
                Securite::verifierConnexion();
                $avisController->valider_supprimer_avis();
            }
            break;
            

        case "contact":$contactController->contact();
            break;

        case "validation_contact":
            if(isset($_POST["nom"]) && isset($_POST["prenom"]) & isset($_POST["email"]) &&  isset($_POST["message"]) &&  
            !empty($_POST["nom"]) && !empty($_POST["prenom"])  && !empty($_POST["email"]) && !empty($_POST["message"])){
                $nom = Securite::SecureHTML($_POST["nom"]);
                $prenom = Securite::SecureHTML($_POST["prenom"]);
                $email= Securite::SecureHTML($_POST["email"]);
                $message = Securite::SecureHTML($_POST["message"]);
                $contactController->validationFormulaireContact($nom, $prenom, $email, $message);
                header("location:". URL. "accueil");
            }else{
                Toolbox::ajouterMessageAlerte("Veuillez renseigner tous les champs demandés", Toolbox::COULEUR_ROUGE);
                header("location:". URL . "contact");
            }
            break;

        case "login":$utilisateurController->login();
            break;

        case "validation_login":
            if(isset($_POST["email"]) && isset($_POST["password"]) &&
             !empty($_POST["email"]) && !empty($_POST["password"])){
                $email = Securite::SecureHTML($_POST["email"]);
                $password = Securite::SecureHTML($_POST["password"]);
                $utilisateurController->validation_login($email, $password);
            }else{
                Toolbox::ajouterMessageAlerte("Login ou mot de passe non renseigné", Toolbox::COULEUR_ROUGE);
                header("location:". URL . "login");
            }
            break;
            
        case "compte": 
            if(!Securite::estConnecte()){
                Toolbox::ajouterMessageAlerte("Veuillez vous connectez !", Toolbox::COULEUR_ROUGE);
                header("location:". URL . "login");
            }elseif(!Securite::checkCookieConnexion()){
                Toolbox::ajouterMessageAlerte("Veuillez vous reconnectez  !", Toolbox::COULEUR_ROUGE);
                setcookie(Securite::COOKIE_NAME, "", time() -3600);
                unset($_SESSION["profil"]);
                header("location:". URL . "login");
            }else{                
                Securite::genererCookieConnexion();//regéneration du cookie
                switch($url[1]){
                    case "accueil": $serviceController->accueil();
                    break;
                    case "page_gestion_employe": $utilisateurController->page_gestion_employe();
                    break;
                    case "deconnexion": $utilisateurController->deconnexion();
                    break;
                    default : throw new Exception("La page n'existe pas");
                }
             }
            break;

            
        case "administrateur" : 
            if(!Securite::estConnecte()){
                Toolbox::ajouterMessageAlerte("Veuillez vous connectez", Toolbox::COULEUR_ROUGE);
                header("location:". URL . "login");
            }elseif(!Securite::estAdministrateur()){
                Toolbox::ajouterMessageAlerte("Vous n'avez pas le droit d'etre ici !", Toolbox::COULEUR_ROUGE);
                header("location:". URL . "accueil");
            }else{
                switch($url[1]){
                    case "administration" :$utilisateurController->administration();
                    break;
                    case "generer_compte_employe" : $utilisateurController->generateEmploye();
                    break;
                    case "validation_creation_compte" : $utilisateurController->validGenerationEmploye();
                    break;
                    default : throw new Exception("La page n'existe pas");
                }
            }
            break;


        case "error403": throw new Exception("La page n'esxiste pas error 403");
        break;
        case "error404": throw new Exception("La page n'esxiste pas error 404");
        break;
        case "error500": throw new Exception("La page n'esxiste pas error 500");
        break;
        
        default: throw new Exception("La page n'existe pas ! ");
    }
    
} catch (Exception $e) {
    $mainController->getErreur($e->getMessage());
}

