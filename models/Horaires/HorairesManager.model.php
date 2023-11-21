<?php
require_once "./models/MainManager.model.php";
require_once("models/Horaires/Horaires.class.php");


Class HoraireManager extends Model{

    private $horaires;

    public function ajoutHoraires($horaire){
        $this->horaires[] = $horaire;
    }

    public function getHoraires(){
        return $this->horaires;
    }

    public function chargementHoraires(){
        $req = "SELECT * FROM horaires";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $nosHoraires = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        foreach ($nosHoraires as $horaire) {
            $s = new Horaires($horaire["id"], $horaire["jour"], $horaire["debut_heures_AM"], $horaire["fin_heures_AM"], $horaire["debut_heures_PM"], $horaire["fin_heures_PM"], $horaire["est_ouvert"]);
            $this->ajoutHoraires($s);
        }
    }

    public function getHorairesById($id){
        for($i=0; $i<count($this->horaires); $i++){
            if((int)$this->horaires[$i]->getId() === (int)$id);
                return $this->horaires[$i];
        }
    }

    public function ModifierHorairesBD($index, $debutHeure_AM, $finHeure_AM, $debutHeure_PM, $finHeure_PM, $status){
        $req = "UPDATE horaires SET debut_heures_AM = :debutHeure_AM, fin_heures_AM = :finHeure_AM, debut_heures_PM = :debutHeure_PM,
         fin_heures_PM = :finHeure_PM, est_ouvert = :status WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $index, PDO::PARAM_INT);
        $stmt->bindValue(":debutHeure_AM", $debutHeure_AM, PDO::PARAM_STR);
        $stmt->bindValue(":finHeure_AM", $finHeure_AM, PDO::PARAM_STR);
        $stmt->bindValue(":debutHeure_PM", $debutHeure_PM, PDO::PARAM_STR);
        $stmt->bindValue(":finHeure_PM", $finHeure_PM, PDO::PARAM_STR);
        $stmt->bindValue(":status", $status, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
     }
     
}


