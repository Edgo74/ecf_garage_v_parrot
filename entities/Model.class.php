<?php

abstract class Model
{
    private static $pdo;

    private static function setBdd()
    {
        $url = parse_url(getenv("JAWSDB_URL"));
        $host = $url["host"];
        $db  = substr($url["path"], 1);
        $user = $url["user"];
        $pass = $url["pass"];
        $port = $url["port"];

        try {
            self::$pdo = new PDO("mysql:host=$host;dbname=$db;port=$port;charset=utf8", $user, $pass);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur lors de la connexion a la bdd :" . $e->getMessage();
            exit();
        }
    }

    protected function getBdd()
    {
        if (self::$pdo === null) {
            self::setBdd();
        }
        return self::$pdo;
    }
}
