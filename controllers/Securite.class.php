<?php 

Class Securite{
    public const COOKIE_NAME = "timers";

    public static function SecureHTML($chaine){
        return htmlentities($chaine);
    }

    public static function estConnecte(){
        return isset($_SESSION["profil"]) && !empty($_SESSION["profil"]);
    }
    
    public static function estEmploye(){
        return isset($_SESSION["profil"]["role"]) && $_SESSION["profil"]["role"] === "employe";
    }
    
    public static function estAdministrateur(){
        return isset($_SESSION["profil"]["role"]) && $_SESSION["profil"]["role"] === "administrateur";
    }

    
    public static function genererCookieConnexion(){
        $ticket = session_id().microtime().rand(0, 999999);
        $ticket = hash("sha512", $ticket);
        setcookie(self::COOKIE_NAME, $ticket, time()+(60*20));
        $_SESSION["profil"][self::COOKIE_NAME] = $ticket;
    }

    public static function checkCookieConnexion(){
        return $_COOKIE[self::COOKIE_NAME] === $_SESSION["profil"][self::COOKIE_NAME];
    }
    
    public static function verifierConnexion() {
        if(!self::estConnecte()){
            Toolbox::ajouterMessageAlerte("Veuillez vous connecter !", Toolbox::COULEUR_ROUGE);
            header("location:". URL . "login");
            exit();
        }
    }
    public static function verifierConnexionAdmin() {
        if(!self::estConnecte() || !self::estAdministrateur()){
            Toolbox::ajouterMessageAlerte("Vous n'avez pas le droit d'accéder a cette page !", Toolbox::COULEUR_ROUGE);
            header("location:". URL . "login");
            exit(); 
        }
    }
}