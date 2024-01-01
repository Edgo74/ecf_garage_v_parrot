
<?php

require_once("controllers/Maincontroller.controller.php");
require_once("models/Utilisateur/Utilisateur.model.php");


class UtilisateurController extends MainController
{

    private $utilisateurManager;

    public function __construct()
    {
        $this->utilisateurManager = new UtilisateurManager();
    }
    public function login()
    {
        $data_page = [
            "page_description" => "page de login",
            "page_title" => "Titre page de login",
            "page_css" => "login.css",
            "view" => "views/Utilisateur/login.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }
    public function Profil()
    {
        $datas = $this->utilisateurManager->getUserInformation($_SESSION["profil"]["login"]);
        $data_page = [
            "page_description" => "page de profil",
            "page_title" => "Titre page de profil",
            "utilisateur" => $datas,
            "page_javascript" => "profil.js",
            "view" => "views/Utilisateur/profil.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }


    public function validation_login($email, $password)
    {
        if (
            $this->utilisateurManager->isCombinaisonValide($email, $password)
        ) {

            $token = Securite::generateToken($this->utilisateurManager->getUserRole($email));

            setcookie('token', $token, [
                'expires' => time() + (60 * 60 * 24),
                'path' => '/',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Strict',
            ]);


            Toolbox::ajouterMessageAlerte("Bon retour sur le site !", Toolbox::COULEUR_VERTE);
            $_SESSION["profil"] = [
                "login" => $email,
            ];
            Securite::genererCookieConnexion();
            $datas = $this->utilisateurManager->getUserInformation($_SESSION["profil"]["login"]);
            if ($datas["role"] === "administrateur") {
                header("location:" . URL . "administrateur/administration");
            } else {
                header("location:" . URL . "compte/page_gestion_employe");
            }
        } else {
            Toolbox::ajouterMessageAlerte("Combinaison Login/Mot de passe invalide", Toolbox::COULEUR_ROUGE);
            header("location:" . URL . "login");
        }
    }


    public function deconnexion()
    {
        Toolbox::ajouterMessageAlerte("La deconnexion est effectuée", Toolbox::COULEUR_VERTE);
        unset($_SESSION['profil']);
        setcookie(Securite::COOKIE_NAME, "", time() - 3600, "/");
        header("Location:" . URL . "accueil");
    }

    public function administration()
    {
        $data_page = [
            "page_description" => "Page d'admin",
            "page_title" => "Page d'administration du site",
            "page_css" => "admin.css",
            "view" => "views/Utilisateur/admin.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function modificationPassword()
    {
        $data_page = [
            "page_description" => "Page de modification du password",
            "page_title" => "Page de modification du password",
            "page_javascript" => "modificationPassword.js",
            "view" => "views/Utilisateur/modificationPassword.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function validationModificationPassword($ancienPassword, $nouveauPassword, $confirmationNouveauPassword)
    {
        if ($nouveauPassword === $confirmationNouveauPassword) {
            if ($this->utilisateurManager->isCombinaisonValide($_SESSION['profil']['login'], $ancienPassword)) {
                if (!self::checkMatchPasswords($nouveauPassword)) {
                    $passwordCrypte = password_hash($nouveauPassword, PASSWORD_DEFAULT);
                    if ($this->utilisateurManager->bdModificationPassword($_SESSION['profil']['login'], $passwordCrypte)) {
                        Toolbox::ajouterMessageAlerte("La modification du password a été effectuée", Toolbox::COULEUR_VERTE);
                        header("Location: " . URL . "compte/profil");
                    } else {
                        Toolbox::ajouterMessageAlerte("La modification a échouée", Toolbox::COULEUR_ROUGE);
                        header("Location: " . URL . "compte/modificationPassword");
                    }
                } else {
                    Toolbox::ajouterMessageAlerte("Le mot de passe doit contenir au moins 10 caractères, au moins un minuscule, un majuscule et un caractère spécial.", Toolbox::COULEUR_ROUGE);
                    header("location:" . URL . "compte/modificationPassword");
                }
            } else {
                Toolbox::ajouterMessageAlerte("La combinaison login / ancien password ne correspond pas", Toolbox::COULEUR_ROUGE);
                header("Location: " . URL . "compte/modificationPassword");
            }
        } else {
            Toolbox::ajouterMessageAlerte("Les passwords ne correspondent pas", Toolbox::COULEUR_ROUGE);
            header("Location: " . URL . "compte/modificationPassword");
        }
    }


    public function validationModificationProfilImage($file)
    {
        try {
            $repertoire = "public/Assets/images/profils/";
            $nomImage = Toolbox::ajoutImage($file, $repertoire);
            $this->dossierSuppressionImageUtilisateur($_SESSION['profil']['login']);
            $nomImageBD = "profils/" . $nomImage;
            if ($this->utilisateurManager->bdAjoutImage($_SESSION['profil']['login'], $nomImageBD)) {
                Toolbox::ajouterMessageAlerte("La modification de l'image est effectuée", Toolbox::COULEUR_VERTE);
            } else {
                Toolbox::ajouterMessageAlerte("La modification de l'image n'a pas été effectuée", Toolbox::COULEUR_ROUGE);
            }
        } catch (Exception $e) {
            Toolbox::ajouterMessageAlerte($e->getMessage(), Toolbox::COULEUR_ROUGE);
        }

        header("Location: " . URL . "compte/profil");
    }

    private function dossierSuppressionImageUtilisateur($mail)
    {
        $ancienneImage = $this->utilisateurManager->getImageUtilisateur($_SESSION['profil']['login']);
        if ($ancienneImage !== "profils/profil.png") {
            unlink("public/Assets/images/" . $ancienneImage);
        }
    }


    public function page_gestion_employe()
    {
        $data_page = [
            "page_description" => "Page de gestion pour les employé",
            "page_title" => "Page de gestion des employés",
            "page_css" => "admin.css",
            "view" => "views/Utilisateur/employe.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function generateEmploye()
    {
        $data_page = [
            "page_description" => "Page pour créer un compte employé",
            "page_title" => "Génerer un compte employé",
            "page_css" => "login.css",
            "view" => "views/Utilisateur/generateEmploye.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function validGenerationEmploye()
    {
        $employe_password = Securite::SecureHTML($_POST["employe_password"]);
        $employe_mail = Securite::SecureHTML($_POST["employe_mail"]);
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            Toolbox::ajouterMessageAlerte("vous n'avez pas le droit d envoyer ce formulaire", Toolbox::COULEUR_ROUGE);
            header("location:" . URL . "administrateur/generer_compte_employe");
        } elseif (self::checkMatchPasswords($employe_password)) {
            Toolbox::ajouterMessageAlerte("Le mot de passe doit contenir au moins 10 caractères, au moins un minuscule, un majuscule et un caractère spécial.", Toolbox::COULEUR_ROUGE);
            header("location:" . URL . "administrateur/generer_compte_employe");
        } else {
            $this->utilisateurManager->validationCreationCompteEmploye($employe_password,  $employe_mail);
            Toolbox::ajouterMessageAlerte("Création de compte effectué avec succes", Toolbox::COULEUR_VERTE);
            header("location:" . URL .  "administrateur/generer_compte_employe");
        }
    }


    public function checkMatchPasswords($password)
    {
        $passwordSecure = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,}$/";
        return !preg_match($passwordSecure, $password);
    }

    public function mentionslegales()
    {
        $data_page = [
            "page_description" => "Page mentions légales",
            "page_title" => "Mentions Légales",
            "view" => "views/Commons/mentions.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }
}
