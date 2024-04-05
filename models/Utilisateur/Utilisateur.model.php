
<?php

require_once "models/MainManager.model.php";
require_once "entities/Utilisateur/Utilisateur.class.php";
require_once "controllers/Utilisateur/Utilisateur.controller.php";

class UtilisateurManager extends MainManager
{


    private $utilisateur;

    public function ajoutUtilisateur($user)
    {
        $this->utilisateur[] = $user;
    }

    public function getUsers()
    {
        return $this->utilisateur;
    }

    public function chargementUtilisateur()
    {
        $req = "SELECT * FROM utilisateur";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        foreach ($utilisateurs as $utilisateur) {
            $u = new Utilisateur($utilisateur["utilisateur_id"], $utilisateur["password"], $utilisateur["mail"], $utilisateur["role"]);
            $this->ajoutUtilisateur($u);
        }
    }

    public function getUserRole($mail)
    {
        $req = "SELECT * FROM utilisateur WHERE mail = :mail";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result["role"];
    }

    public function getPasswordUser($mail)
    {
        $req = "SELECT password FROM utilisateur WHERE mail = :mail";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $admin["password"];
    }

    public function bdModificationPassword($mail, $password)
    {
        $req = "UPDATE utilisateur set password = :password WHERE mail = :mail";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }



    public function isCombinaisonValide($email, $password)
    {
        $passwordBD =  $this->getPasswordUser($email);
        return password_verify($password, $passwordBD);
    }

    public function getUserInformation($mail)
    {
        $req = "SELECT * FROM utilisateur WHERE mail = :mail";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public function supprimerEmployeBD($utilisateur_id)
    {
        $req = "DELETE FROM utilisateur WHERE utilisateur_id = :utilisateur_id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":utilisateur_id", $utilisateur_id, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function validationCreationCompteEmploye($employe_password, $employe_mail)
    {
        $password = password_hash($employe_password, PASSWORD_DEFAULT);
        $req = "INSERT INTO utilisateur(password, mail) VALUES(:password, :mail)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->bindValue(":mail", $employe_mail, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function validationResetPassword($email)
    {
        $token = bin2hex(random_bytes(32));
        $token_hash = hash("sha256", $token);
        $expiry = date("Y-m-d H:i:s", time() + 60 * 30);
        $req = "UPDATE utilisateur set reset_token_hash = :token, reset_token_expires_at = :expiry WHERE mail = :mail";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":token", $token_hash, PDO::PARAM_STR);
        $stmt->bindValue(":expiry", $expiry, PDO::PARAM_STR);
        $stmt->bindValue(":mail", $email, PDO::PARAM_STR);
        $result = $stmt->execute();
        if ($result) {
            $contactController = new ContactController();
            $contactController->sendEmailResetPassword($email, $token);
        }
    }

    public function validationUpdatepassword($password, $token)
    {
        $token_hash = hash("sha256", $token);
        $req = "SELECT * FROM utilisateur WHERE reset_token_hash = :token AND reset_token_expires_at > :now";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":token", $token_hash, PDO::PARAM_STR);
        $stmt->bindValue(":now", date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        if ($result) {
            $req = "UPDATE utilisateur set password = :password, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE reset_token_hash = :token";
            $stmt = $this->getBdd()->prepare($req);
            $stmt->bindValue(":password", $password, PDO::PARAM_STR);
            $stmt->bindValue(":token", $token_hash, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
            return true;
        }
        return false;
    }
}
