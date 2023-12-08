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
            "page_css" => "style.css",
            "view" => "views/contact.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }




    public function validationFormulaireContact($nom, $prenom, $email, $message)
    {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            Toolbox::ajouterMessageAlerte("vous n'avez pas le droit d envoyer ce formulaire", Toolbox::COULEUR_ROUGE);
        } else {
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io'; // ou 'live.smtp.mailtrap.io' pour le serveur en direct
            $mail->SMTPAuth = true;
            $mail->Username = getenv('MAILTRAP_USERNAME');
            $mail->Password = getenv('MAILTRAP_PASSWORD');
            //$mail->SMTPSecure = 'tls';
            $mail->Port = 465;

            $mail->setFrom('adambayar1357@gmail.com',  $nom . "-" . $prenom);
            $mail->addAddress('lerepairedu74@gmail.com', 'lerepaire-2');
            $mail->addReplyTo('adambayar1357@gmail.com', 'lerepaire-3');

            $mail->isHTML(true);

            $mail->Subject = 'Here is the subject';
            $mail->Body = 'Mail : ' . $email . ' <br> ' . $message;

            if (!$mail->send()) {
                Toolbox::ajouterMessageAlerte("Un probleme est survenu veuillez réessayer", Toolbox::COULEUR_ROUGE);
                header("location:" . URL . "contact");
            } else {
                Toolbox::ajouterMessageAlerte("Message Envoyé", Toolbox::COULEUR_VERTE);
                header("location:" . URL . "accueil");
            }
            // $destinataire = "adambayar1357@gmail.com";
            // $mail = mail($destinataire, "-" . $nom . "- " . $prenom, "Mail :" . $email . "Message :" . $message);
            // if ($mail) {
            //     Toolbox::ajouterMessageAlerte("Message Envoyé", Toolbox::COULEUR_VERTE);
            //     header("location:" . URL . "accueil");
            // } else {
            //     Toolbox::ajouterMessageAlerte("Un probleme est survenu veuillez réessayer", Toolbox::COULEUR_ROUGE);
            //     header("location:" . URL . "contact");
            // }
        }
    }
}
