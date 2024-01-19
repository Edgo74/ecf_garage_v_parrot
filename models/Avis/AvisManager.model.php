<?php

require_once("models/MainManager.model.php");
require("objects/Avis/Avis.class.php");



class AvisManager extends Model
{

    private $avis;

    public function ajoutAvis($avi)
    {
        $this->avis[] = $avi;
    }

    public function getAvis()
    {
        return $this->avis;
    }

    public function chargementAvis()
    {
        $req = "SELECT * FROM avis";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $lesAvis = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        foreach ($lesAvis as $avis) {
            $s = new Avis($avis["id"], $avis["nom"], $avis["commentaire"], $avis["note"],  $avis["estValide"]);
            $this->ajoutAvis($s);
        }
    }

    public function getAvisById($id)
    {
        for ($i = 0; $i < count($this->avis); $i++) {
            if ((int)$this->avis[$i]->getId() === (int)$id);
            return $this->avis[$i];
        }
    }

    public function validerAjoutAvisBD($nom, $note, $commentaire, $estValide)
    {
        $req = "INSERT INTO avis(nom, note, commentaire, estValide) VALUES(:nom, :note, :commentaire, :estValide)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":note", $note, PDO::PARAM_STR);
        $stmt->bindValue(":commentaire", $commentaire, PDO::PARAM_STR);
        $stmt->bindValue(":estValide", $estValide, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $avis =  new Avis($this->getBdd()->lastInsertId(), $nom, $note, $commentaire, $estValide);
            $this->ajoutAvis($avis);
        }
    }

    public function supprimeAvisBD($id)
    {
        $req = "DELETE FROM avis WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $avis = $this->getAvisById($id);
            unset($avis);
        }
    }

    public function validerAvisBD($id)
    {
        $req = "UPDATE avis SET estValide = 1 WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        return $resultat;
    }

    // public function valider_supprimer_avis_BD()
    // {
    //     $id = Securite::SecureHTML($_POST["avisId"]);
    //     $stmt = $this->getBdd()->prepare("SELECT * FROM avis WHERE id = :id");
    //     $stmt->bindValue(':id',  $id, PDO::PARAM_INT);
    //     $resultat = $stmt->execute();
    //     $output = '';
    //     if ($resultat > 0) {
    //         $avisDetails = $stmt->fetch(PDO::FETCH_OBJ);
    //         $output = json_encode($avisDetails);
    //     } else {
    //         $output = json_encode(['error' => 'No Data Found']);
    //     }
    //     $output = html_entity_decode($output, ENT_QUOTES, 'UTF-8');
    //     echo $output;
    // }
}
