<?php

require_once("models/MainManager.model.php");
require("entities/Avis/Avis.class.php");



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
        $url = isset($_GET["page"]) ? explode("/", filter_var($_GET["page"], FILTER_SANITIZE_URL)) : 1;
        $page = isset($url[2]) ? $url[2] : 1;
        $limit = 5;
        $start = ($page - 1) * $limit;
        $req = "SELECT * FROM avis LIMIT :start, :limit";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindValue(":start", $start, PDO::PARAM_INT);
        $stmt->execute();
        $lesAvis = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        foreach ($lesAvis as $avis) {
            $s = new Avis($avis["avis_id"], $avis["nom"], $avis["commentaire"], $avis["note"],  $avis["estValide"]);
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
        $req = "DELETE FROM avis WHERE avis_id = :id";
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
        $req = "UPDATE avis SET estValide = 1 WHERE avis_id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        return $resultat;
    }

    public function getTotalPages()
    {
        $req = "SELECT COUNT(avis_id) FROM avis";
        $stmt = $this->getBdd()->query($req);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $totalRecords = $row[0];
        $totalPages = ceil($totalRecords / 5);
        return $totalPages;
    }
}
