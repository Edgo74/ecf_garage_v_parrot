
<?php

require_once "./models/MainManager.model.php";

class UtilisateurManager extends MainManager{

    public function getPasswordUser($mail){
        $req = "SELECT password FROM utilisateur WHERE mail = :mail";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $admin["password"];

    }
    public function isCombinaisonValide($email, $password){
       $passwordBD =  $this->getPasswordUser($email);
       return password_verify($password, $passwordBD);
    }

    public function getUserInformation($mail){
        $req = "SELECT * FROM utilisateur WHERE mail = :mail";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public function validationCreationCompteEmploye($employe_password, $employe_mail){
        $password = password_hash($employe_password, PASSWORD_DEFAULT);
        $req = "INSERT INTO utilisateur(password, mail) VALUES(:password, :mail)";
        $stmt= $this->getBdd()->prepare($req);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->bindValue(":mail", $employe_mail, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
    }

}
