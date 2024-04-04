<?php
require  'vendor/autoload.php';
require_once("models/Utilisateur/Utilisateur.model.php");

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Dotenv\Dotenv;

// Load the .env file
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');

$dotenv->load();

class Securite
{
    public const COOKIE_NAME = "timers";


    public static function genererCookieConnexion()
    {
        $ticket = session_id() . microtime() . rand(0, 999999);
        $ticket = hash("sha512", $ticket);
        setcookie(self::COOKIE_NAME, $ticket, time() + (60 * 60), "/");
        $_SESSION["profil"][self::COOKIE_NAME] = $ticket;
    }

    public static function checkCookieConnexion()
    {
        return $_COOKIE[self::COOKIE_NAME] === $_SESSION["profil"][self::COOKIE_NAME];
    }


    public static function SecureHTML($chaine)
    {
        return htmlentities($chaine);
    }

    public static function estConnecte()
    {
        return isset($_SESSION["profil"]) && !empty($_SESSION["profil"])
            && isset($_COOKIE['token']) && self::verifyToken($_COOKIE['token']);
    }


    public static function verifierConnexion()
    {
        if (!self::estConnecte()) {
            Toolbox::ajouterMessageAlerte("Veuillez vous connecter !", Toolbox::COULEUR_ROUGE);
            header("location:" . URL . "login");
            exit();
        }
    }

    public static function generateToken($role)
    {
        $key = getenv("SECRET_KEY");
        $payload = array(
            'role' => $role,
            'iat' => time(),
            'exp' => time() + (24 * 60 * 60)
        );
        $algorithm = 'HS256';
        $token = JWT::encode($payload, $key, $algorithm);
        return $token;
    }

    public static function verifyToken($token)
    {
        $key = getenv("SECRET_KEY");
        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            $role = $decoded->role;
            return array('success' => true,  'role' => $role);
        } catch (Exception $e) {
            Toolbox::ajouterMessageAlerte($e->getMessage(), Toolbox::COULEUR_ROUGE);
            return array();
        }
    }

    public static function isAdmin()
    {
        if (isset($_COOKIE['token']) && self::verifyToken($_COOKIE['token'])) {
            $verificationResult = self::verifyToken($_COOKIE['token']);
            if (isset($verificationResult['success']) && $verificationResult['role']) {
                $role = $verificationResult['role'];
                if ($role !== 'administrateur') {
                    return false;
                } else {
                    return true;
                }
            }
        } else {
            return false;
        }
    }


    public static function isConnectedAndAdmin()
    {
        if (!self::estConnecte() || !self::isAdmin() || !self::checkCookieConnexion()) {
            Toolbox::ajouterMessageAlerte("Vous n'avez pas le droit d'accéder a cette page !", Toolbox::COULEUR_ROUGE);
            setcookie(Securite::COOKIE_NAME, "", time() - 3600, "/");
            unset($_SESSION["profil"]);
            header("location:" . URL . "login");
            exit();
        }
    }
}
