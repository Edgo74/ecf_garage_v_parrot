<?php 
require_once("controllers/Maincontroller.controller.php");

class ContactController extends MainController{

    public function contact(){
        $data_page = [
            "page_description" => "page de contact ",
            "page_title" => "page de Contact",
            "page_css" => "style.css",
            "view" => "views/contact.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function validationFormulaireContact($nom, $prenom, $email, $message){
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            Toolbox::ajouterMessageAlerte("vous n'avez pas le droit d envoyer ce formulaire", Toolbox::COULEUR_ROUGE);
        }else{
            $destinataire = "adambayar1357@gmail.com";
            $mail = mail($destinataire, "-". $nom . "- " . $prenom, "Mail :". $email . "Message :" .$message);
            if($mail){
                Toolbox::ajouterMessageAlerte("Message Envoyé", Toolbox::COULEUR_VERTE);
                header("location:". URL. "accueil");
            }else{
                Toolbox::ajouterMessageAlerte("Un probleme est survenu veuillez réessayer", Toolbox::COULEUR_ROUGE);
                header("location:". URL. "contact");
            }
        }    
    }
} 