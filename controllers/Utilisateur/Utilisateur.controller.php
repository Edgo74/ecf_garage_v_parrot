
<?php

require_once("controllers/Maincontroller.controller.php");
require_once("models/Utilisateur/Utilisateur.model.php");


class UtilisateurController extends MainController
{

    private $utilisateurManager;

    public function __construct()
    {
        $this->utilisateurManager = new UtilisateurManager();
        $this->utilisateurManager->chargementUtilisateur();
    }
    public function login()
    {
        //echo password_hash("P@ssw0rd!", PASSWORD_DEFAULT);
        $data_page = [
            "page_description" => "page de login",
            "page_title" => "Titre page de login",
            "page_css" => "login.css",
            "view" => "views/Utilisateur/login.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function reset_password()
    {
        $data_page = [
            "page_description" => "réinistialisation du mot de passe",
            "page_title" => "Titre page de réinitialisation du mot de passe",
            "page_css" => "login.css",
            "view" => "views/Utilisateur/reset_password.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }


    public function update_password($token)
    {
        $_SESSION['token'] = $token;
        $data_page = [
            "page_description" => "réinistialisation du mot de passe",
            "page_title" => "Titre page de réinitialisation du mot de passe",
            "page_css" => "login.css",
            "view" => "views/Utilisateur/update_password.view.php",
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
            "page_css" => "profil.css",
            "page_javascript" => ["profil.js"],
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

    public function validation_reset_password($email)
    {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            Toolbox::ajouterMessageAlerte("vous n'avez pas le droit d envoyer ce formulaire", Toolbox::COULEUR_ROUGE);
            header("location:" . URL . "reset_password");
        } elseif ($this->utilisateurManager->getUserInformation($email)) {
            $this->utilisateurManager->validationResetPassword($email);
            header("location:" . URL . "reset_password");
        } else {
            Toolbox::ajouterMessageAlerte("Aucun utilisateur avec cette adresse mail", Toolbox::COULEUR_ROUGE);
            header("location:" . URL . "reset_password");
        }
    }



    public function validation_update_password($password, $token)
    {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            Toolbox::ajouterMessageAlerte("vous n'avez pas le droit d envoyer ce formulaire", Toolbox::COULEUR_ROUGE);
            header("location:" . URL . "update_password/" . $token);
        } elseif (self::checkMatchPasswords($password)) {
            Toolbox::ajouterMessageAlerte("Le mot de passe doit contenir au moins 10 caractères, au moins un minuscule, un majuscule et un caractère spécial.", Toolbox::COULEUR_ROUGE);
            header("location:" . URL . "update_password/" . $token);
        } else {
            $passwordCrypte = password_hash($password, PASSWORD_DEFAULT);
            if ($this->utilisateurManager->validationUpdatePassword($passwordCrypte, $token)) {
                Toolbox::ajouterMessageAlerte("La modification du password a été effectuée", Toolbox::COULEUR_VERTE);
                header("location:" . URL . "login");
            } else {
                Toolbox::ajouterMessageAlerte("La modification a échouée", Toolbox::COULEUR_ROUGE);
                header("location:" . URL . "update_password/" . $token);
            }
        }
    }

    public function deconnexion()
    {
        Toolbox::ajouterMessageAlerte("La deconnexion est effectuée", Toolbox::COULEUR_VERTE);
        unset($_SESSION['profil']);
        setcookie(Securite::COOKIE_NAME, "", time() - 3600, "/");
        header("Location:" . URL . "login");
    }

    public function administration()
    {
        $data_page = [
            "page_description" => "Page d'admin",
            "page_title" => "Page d'administration du site",
            "page_css" => "admin.css",
            "page_javascript" => ["admin.js"],
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
            "page_javascript" => ["modificationPassword.js"],
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


    public function page_gestion_employe()
    {
        $data_page = [
            "page_description" => "Page de gestion pour les employé",
            "page_title" => "Page de gestion des employés",
            "page_css" => "admin.css",
            "page_javascript" => ["admin.js"],
            "view" => "views/Utilisateur/employe.view.php",
            "template" => "views/Commons/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function generateEmploye()
    {
        $utilisateurs = $this->utilisateurManager->getUsers();
        $data_page = [
            "utilisateurs" => $utilisateurs,
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
        } elseif ($this->utilisateurManager->getUserInformation($employe_mail)) {
            Toolbox::ajouterMessageAlerte("Un utilisateur avec cette adresse mail existe déjà", Toolbox::COULEUR_ROUGE);
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

    public function supprimerEmploye($id)
    {
        $this->utilisateurManager->supprimerEmployeBD($id);
        Toolbox::ajouterMessageAlerte("Employé supprimé", Toolbox::COULEUR_VERTE);
        header("location:" . URL . "administrateur/page_gestion_employe");
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
