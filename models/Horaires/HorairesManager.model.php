<?php
require_once "models/MainManager.model.php";
require_once("entities/Horaires/Horaires.class.php");


class HoraireManager extends Model
{

    private $horaires;

    public function ajoutHoraires($horaire)
    {
        $this->horaires[] = $horaire;
    }

    public function getHoraires()
    {
        return $this->horaires;
    }

    public function chargementHoraires()
    {
        $req = "SELECT * FROM horaires";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $nosHoraires = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        foreach ($nosHoraires as $horaire) {
            $s = new Horaires($horaire["horaire_id"], $horaire["jour"], $horaire["debut_heures_AM"], $horaire["fin_heures_AM"], $horaire["debut_heures_PM"], $horaire["fin_heures_PM"], $horaire["est_ouvert"]);
            $this->ajoutHoraires($s);
        }
    }

    public function getHorairesById($id)
    {
        for ($i = 0; $i < count($this->horaires); $i++) {
            if ((int)$this->horaires[$i]->getId() === (int)$id);
            return $this->horaires[$i];
        }
    }

    public function ModifierHorairesBD($id, $statut, $debutAM, $finAM, $debutPM, $finPM)
    {
        $req = "UPDATE horaires SET debut_heures_AM = :debutHeure_AM, fin_heures_AM = :finHeure_AM, debut_heures_PM = :debutHeure_PM,
        fin_heures_PM = :finHeure_PM, est_ouvert = :status WHERE horaire_id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":debutHeure_AM", $debutAM, PDO::PARAM_STR);
        $stmt->bindValue(":finHeure_AM", $finAM, PDO::PARAM_STR);
        $stmt->bindValue(":debutHeure_PM", $debutPM, PDO::PARAM_STR);
        $stmt->bindValue(":finHeure_PM", $finPM, PDO::PARAM_STR);
        $stmt->bindValue(":status", $statut, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
    }


    public function modifierLesHorairesBD()
    {
        $jour = Securite::SecureHTML($_POST["jourId"]);
        $stmt = $this->getBdd()->prepare("SELECT * FROM horaires WHERE horaire_id= :jour");
        $stmt->bindValue(':jour', $jour, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $output = '';
        if ($resultat > 0) {
            $serviceDetails = $stmt->fetch(PDO::FETCH_OBJ);
            $output = json_encode($serviceDetails);
        } else {
            $output = json_encode(['error' => 'No Data Found']);
        }
        $output = html_entity_decode($output, ENT_QUOTES, 'UTF-8');
        echo $output;
    }
}
