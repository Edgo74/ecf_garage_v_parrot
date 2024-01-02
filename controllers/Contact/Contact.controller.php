<?php
require_once("controllers/Maincontroller.controller.php");
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class ContactController extends MainController
{

    public function contact()
    {
        $data_page = [
            "page_description" => "page de contact ",
            "page_title" => "page de Contact",
            "page_css" => "main.css",
            "view" => "views/contact.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function validationFormulaireContact()
    {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            Toolbox::ajouterMessageAlerte("vous n'avez pas le droit d envoyer ce formulaire", Toolbox::COULEUR_ROUGE);
        } else if (
            !isset($_POST["sujet"]) && !isset($_POST["nom"]) && !isset($_POST["prenom"])
            && !isset($_POST["email"])  &&  !isset($_POST["message"]) && empty($_POST["sujet"])
            && empty($_POST["nom"]) && empty($_POST["prenom"])  && empty($_POST["email"])
            && empty($_POST["message"])
        ) {

            Toolbox::ajouterMessageAlerte("Veuillez renseigner tous les champs demandés", Toolbox::COULEUR_ROUGE);
            header("location:" . URL . "contact");
        } else {
            $sujet = Securite::SecureHTML($_POST["sujet"]);
            $nom = Securite::SecureHTML($_POST["nom"]);
            $prenom = Securite::SecureHTML($_POST["prenom"]);
            $email = Securite::SecureHTML($_POST["email"]);
            $message = Securite::SecureHTML($_POST["message"]);
            // Paramètres du serveur SMTP
            $mail = new PHPMailer(true);
            $my_mail = "adambayar1357@gmail.com";
            $destinataire = "lerepairedu74@gmail.com";
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $my_mail; // Votre adresse Gmail
            $mail->Password   = 'cvrb maed qiej mjli';       // Mot de passe Gmail env file
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // ou SSL si nécessaire
            $mail->Port       = 587; // Port SMTP

            // Destinataire
            $mail->setFrom($my_mail, 'Adam');
            $mail->addAddress($destinataire,  $nom . " " . $prenom);

            // Contenu du message
            $mail->isHTML(true);
            $mail->Subject = htmlspecialchars_decode($sujet . "-" . $email, ENT_QUOTES);
            $mail->Body    = $message;

            // Envoi de l'e-mail
            if ($mail->send()) {
                Toolbox::ajouterMessageAlerte("Message Envoyé", Toolbox::COULEUR_VERTE);
                header("location:" . URL . "accueil");
            } else {
                Toolbox::ajouterMessageAlerte("Un probleme est survenu veuillez réessayer", Toolbox::COULEUR_ROUGE);
                header("location:" . URL . "contact");
            }
        }
    }
}
