<?php
require_once("models/MainManager.model.php");
require_once("entities/Voitures/Voiture.class.php");
class VoitureManager extends Model
{

    private $voitures;

    public function ajoutVoiture($voiture)
    {
        $this->voitures[] = $voiture;
    }

    public function getVoitures()
    {
        return $this->voitures;
    }

    public function chargementVoiture()
    {
        $req = $this->getBdd()->prepare("SELECT * FROM voiture");
        $req->execute();
        $nosvoitures = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach ($nosvoitures as $voiture) {
            $v = new Voitures(
                $voiture["voiture_id"],
                $voiture["titre"],
                $voiture["year"],
                $voiture["carburant"],
                $voiture["kilometre"],
                $voiture["price"],
                $voiture["image"],
                $voiture["immatriculation"],
                $voiture["type"],
                $voiture["date"],
                $voiture["garantie"]
            );
            $this->ajoutVoiture($v);
        }
    }

    public function getVoitureById($id)
    {
        $cardIds = array_map(function ($item) {
            return $item['voiture_id'];
        }, $this->getAllVoituresId());

        if (!in_array($id, $cardIds)) {
            throw new Exception("Cette page n'existe pas");
            exit();
        }
        for ($i = 0; $i < count($this->voitures); $i++) {
            if ((int)$this->voitures[$i]->getId() === (int)$id) {
                return $this->voitures[$i];
            }
        }
    }

    public function getAllVoituresId()
    {
        $req = $this->getBdd()->prepare("SELECT voiture_id FROM voiture");
        $req->execute();
        $voituresId = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $voituresId;
    }

    public function AjoutVoitureBD($titre, $year, $carburant, $kilometre, $price, $image, $immatriculation, $type, $date, $garantie)
    {
        $req = "INSERT INTO voiture(titre, year, carburant, kilometre, price, image, immatriculation, type , date, garantie ) 
        VALUES(:titre, :year, :carburant, :kilometre, :price, :image, :immatriculation, :type , :date, :garantie)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
        $stmt->bindValue(":year", $year, PDO::PARAM_STR);
        $stmt->bindValue(":carburant", $carburant, PDO::PARAM_STR);
        $stmt->bindValue(":kilometre", $kilometre, PDO::PARAM_INT);
        $stmt->bindValue(":price", $price, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $stmt->bindValue(":immatriculation", $immatriculation, PDO::PARAM_STR);
        $stmt->bindValue(":type", $type, PDO::PARAM_STR);
        $stmt->bindValue(":date", $date, PDO::PARAM_STR);
        $stmt->bindValue(":garantie", $garantie, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if ($resultat > 0) {
            $voiture = new Voitures(
                $this->getBdd()->lastInsertId(),
                $titre,
                $year,
                $carburant,
                $kilometre,
                $price,
                $image,
                $immatriculation,
                $type,
                $date,
                $garantie
            );
            $this->ajoutVoiture($voiture);
        }
    }

    public function modificationVoitureBD($id, $titre, $year, $carburant, $kilometre, $price, $image, $immatriculation, $type, $date, $garantie)
    {
        $req = "UPDATE voiture SET titre = :titre, year = :year, carburant = :carburant,
         kilometre = :kilometre, price = :price, image = :image, immatriculation = :immatriculation,
          type = :type , date = :date, garantie = :garantie WHERE voiture_id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
        $stmt->bindValue(":year", $year, PDO::PARAM_STR);
        $stmt->bindValue(":carburant", $carburant, PDO::PARAM_STR);
        $stmt->bindValue(":kilometre", $kilometre, PDO::PARAM_INT);
        $stmt->bindValue(":price", $price, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $stmt->bindValue(":immatriculation", $immatriculation, PDO::PARAM_STR);
        $stmt->bindValue(":type", $type, PDO::PARAM_STR);
        $stmt->bindValue(":date", $date, PDO::PARAM_STR);
        $stmt->bindValue(":garantie", $garantie, PDO::PARAM_INT);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        $resultat = $stmt->execute();
        if ($resultat > 0) {
            $voiture = $this->getVoitureById($id);
            if ($voiture !== null) {
                $voiture->setTitre($titre);
                $voiture->setYear($year);
                $voiture->setCarburant($carburant);
                $voiture->setKilometre($kilometre);
                $voiture->setPrice($price);
                $voiture->setImage($image);
                $voiture->setImmatriculation($immatriculation);
                $voiture->setType($type);
                $voiture->setDate($date);
                $voiture->setGarantie($garantie);
            }
        }
    }

    public function supprimerVoitureBD($id)
    {
        $req = "DELETE FROM voiture WHERE voiture_id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        $req1 = "SELECT image FROM voiture WHERE voiture_id = :id";
        $stmt1 = $this->getBdd()->prepare($req1);
        $stmt1->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt1->execute();
        $image = $stmt1->fetch(PDO::FETCH_ASSOC);

        if ($resultat > 0) {
            $imagePath = "public/Assets/images/" . $image["image"];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }

    public function filtreVoitureBD()
    {
        $minimum_price = Securite::SecureHTML($_POST["minimum_price"]);
        $maximum_price = Securite::SecureHTML($_POST["maximum_price"]);
        $minimum_kilometre = Securite::SecureHTML($_POST["minimum_kilometre"]);
        $maximum_kilometre = Securite::SecureHTML($_POST["maximum_kilometre"]);
        $minimum_year = Securite::SecureHTML($_POST["minimum_year"]);
        $maximum_year = Securite::SecureHTML($_POST["maximum_year"]);
        if (isset($_POST["action"])) {
            $stmt = $this->getBdd()->prepare("SELECT * FROM voiture WHERE price BETWEEN :minimum_price 
            AND :maximum_price AND kilometre BETWEEN :minimum_kilometre AND :maximum_kilometre AND year
             BETWEEN :minimum_year AND :maximum_year");
            $stmt->bindValue(':minimum_price', $minimum_price, PDO::PARAM_INT);
            $stmt->bindValue(':maximum_price', $maximum_price, PDO::PARAM_INT);
            $stmt->bindValue(':minimum_kilometre', $minimum_kilometre, PDO::PARAM_INT);
            $stmt->bindValue(':maximum_kilometre', $maximum_kilometre, PDO::PARAM_INT);
            $stmt->bindValue(':minimum_year', $minimum_year, PDO::PARAM_INT);
            $stmt->bindValue(':maximum_year', $maximum_year, PDO::PARAM_INT);
            $resultat = $stmt->execute();
            $output = '';
            if ($resultat > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $output .= VoitureController::generateCarHtml($row);
                }
            } else {
                $output = '<h3>No Data Found</h3>';
            }
            echo $output;
        }
    }


    public function getEquipements($id)
    {
        $req = "SELECT * FROM equipement e  
        INNER JOIN voiture_equipement ve 
        ON e.equipement_id = ve.equipement_id
        WHERE ve.voiture_id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $equipements = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $equipements;
    }


    public function modifier_supprimer_voiture_BD()
    {
        $id = Securite::SecureHTML($_POST["voitureId"]);
        $stmt = $this->getBdd()->prepare("SELECT * FROM voiture WHERE voiture_id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $output = '';
        if ($resultat > 0) {
            $voitureDetails = $stmt->fetch(PDO::FETCH_OBJ);
            $output = json_encode($voitureDetails);
        } else {
            $output = json_encode(['error' => 'No Data Found']);
        }
        echo $output;
    }
}
