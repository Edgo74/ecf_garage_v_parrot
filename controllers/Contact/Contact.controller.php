

<?php
require_once("controllers/Maincontroller.controller.php");
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');

$dotenv->load();

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
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = getenv('MAILTRAP_USERNAME');
            $mail->Password = getenv('MAILTRAP_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 465;

            $mail->setFrom('adambayar1357@gmail.com',  $nom . "-" . $prenom);
            $mail->addAddress('lerepairedu74@gmail.com', 'lerepaire-2');
            $mail->addReplyTo('adambayar1357@gmail.com', 'lerepaire-3');

            $mail->isHTML(true);

            $mail->Subject =   $sujet;
            $mail->Body = 'Mail : ' . $email . ' <br> ' . $message;

            if (!$mail->send()) {
                Toolbox::ajouterMessageAlerte("Un probleme est survenu veuillez réessayer", Toolbox::COULEUR_ROUGE);
                header("location:" . URL . "contact");
            } else {
                Toolbox::ajouterMessageAlerte("Message Envoyé", Toolbox::COULEUR_VERTE);
                header("location:" . URL . "accueil");
            }
        }
    }



    public function sendEmailResetPassword($email, $token)
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = "adambayar1357@gmail.com";
        $mail->Password   = $_ENV["PASSWORD_EMAIL"];       // Mot de passe Gmail env file
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587; // Port SMTP
        $mail->isHTML(true);

        $mail->setFrom("adambayar1357@gmail.com");
        $mail->addAddress("lerepairedu74@gmail.com");

        $mail->Subject = "Reset Password";
        $mail->Body = <<<END
        <h1>Reset Password</h1>
        <p>Click the link below to reset your password</p>
        <a href="https://app-ecf-garage-3d639a49eac3.herokuapp.com/update_password/$token">Reset Password</a>
        END;

        try {
            $mail->send();
            Toolbox::ajouterMessageAlerte("Un email de réinitialisation de mot de passe a été envoyé à votre adresse e-mail", Toolbox::COULEUR_VERTE);
            header("location:" . URL . "login");
        } catch (Exception $e) {
            Toolbox::ajouterMessageAlerte("Un probleme est survenu veuillez réessayer", Toolbox::COULEUR_ROUGE);
            header("location:" . URL . "reset_password");
        }
    }
}
