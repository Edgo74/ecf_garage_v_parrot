<?php
require_once ("./models/MainManager.model.php");
require_once("models/Voitures/Voiture.class.php");

Class VoitureManager extends Model {

    private $voitures;

    public function ajoutVoiture($voiture){
        $this->voitures[] = $voiture;
    }

    public function getVoitures(){
        return $this->voitures;
    }

    public function chargementVoiture(){
        $req = $this->getBdd()->prepare("SELECT * FROM voitures");
        $req->execute();
        $nosvoitures = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach ($nosvoitures as $voiture) {
            $v = new Voitures($voiture["id"], $voiture["titre"], $voiture["year"], $voiture["carburant"],
            $voiture["kilometre"], $voiture["price"], $voiture["image"]);
            $this->ajoutVoiture($v);
        }
    }

    public function getVoitureById($id){
        for($i=0; $i<count($this->voitures); $i++){
            if((int)$this->voitures[$i]->getId() === (int)$id){
                return $this->voitures[$i];
            }
        }
    }

    public function AjoutVoitureBD($titre, $year, $carburant, $kilometre, $prix, $image){
        $req = "INSERT INTO voitures(titre, year, carburant, kilometre, price, image) 
        VALUES(:titre, :year, :carburant, :kilometre, :price, :image)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
        $stmt->bindValue(":year", $year, PDO::PARAM_STR);
        $stmt->bindValue(":carburant", $carburant, PDO::PARAM_STR);
        $stmt->bindValue(":kilometre", $kilometre, PDO::PARAM_INT);
        $stmt->bindValue(":price", $prix, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat >0){
            $voiture = new Voitures($this->getBdd()->lastInsertId(),$titre, $year, $carburant, $kilometre, $prix, $image);
            $this->ajoutVoiture($voiture);
        }
    }

    public function modificationVoitureBD($id,$titre,$year,$carburant,$kilometre,$price, $image ){
        $req = "UPDATE voitures SET titre = :titre, year = :year, carburant = :carburant,
         kilometre = :kilometre, price = :price, image = :image WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
        $stmt->bindValue(":year", $year, PDO::PARAM_STR);
        $stmt->bindValue(":carburant", $carburant, PDO::PARAM_STR);
        $stmt->bindValue(":kilometre", $kilometre, PDO::PARAM_INT);
        $stmt->bindValue(":price", $price, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0){
            $this->getVoitureById($id)->setTitre($titre);
            $this->getVoitureById($id)->setYear($year);
            $this->getVoitureById($id)->setCarburant($carburant);
            $this->getVoitureById($id)->setKilometre($kilometre);
            $this->getVoitureById($id)->setPrice($price);
            $this->getVoitureById($id)->setImage($image);
        }

    }

    public function supprimerVoitureBD($id){
        $req = "DELETE FROM voitures WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0){
            $voiture = $this->getVoitureById($id);
            $imagePath = "public/Assets/images/". $voiture->getImage();
            unset($voiture);
            if(file_exists($imagePath)){
                unlink($imagePath);
            }
        }
    }

    public function filtreVoitureBD(){
            $minimum_price = Securite::SecureHTML($_POST["minimum_price"]);
            $maximum_price = Securite::SecureHTML($_POST["maximum_price"]);
            $minimum_kilometre = Securite::SecureHTML($_POST["minimum_kilometre"]);
            $maximum_kilometre = Securite::SecureHTML($_POST["maximum_kilometre"]);
            $minimum_year = Securite::SecureHTML($_POST["minimum_year"]);
            $maximum_year = Securite::SecureHTML($_POST["maximum_year"]);
            if(isset($_POST["action"]))
            {
                $stmt = $this->getBdd()->prepare("SELECT * FROM voitures WHERE price BETWEEN :minimum_price AND :maximum_price AND kilometre 
                BETWEEN :minimum_kilometre AND :maximum_kilometre AND year BETWEEN :minimum_year AND :maximum_year");
                $stmt->bindValue(':minimum_price', $minimum_price, PDO::PARAM_INT);
                $stmt->bindValue(':maximum_price', $maximum_price, PDO::PARAM_INT);
                $stmt->bindValue(':minimum_kilometre', $minimum_kilometre, PDO::PARAM_INT);
                $stmt->bindValue(':maximum_kilometre', $maximum_kilometre, PDO::PARAM_INT);
                $stmt->bindValue(':minimum_year', $minimum_year, PDO::PARAM_INT);
                $stmt->bindValue(':maximum_year', $maximum_year, PDO::PARAM_INT);
                $resultat = $stmt->execute();
                $output = '';
                if($resultat > 0){
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                        $output .= VoitureController::generateCarHtml($row);
                    }
                }else{
                    $output = '<h3>No Data Found</h3>';
                }
                echo $output;
            }
    }


    public function modifier_supprimer_voiture_BD(){
        $id = Securite::SecureHTML($_POST["voitureId"]);
        $stmt = $this->getBdd()->prepare("SELECT * FROM voitures WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $output = '';
        if($resultat > 0){
            $voitureDetails = $stmt->fetch(PDO::FETCH_OBJ);
            $output = json_encode($voitureDetails);
        }else{
            $output = json_encode(['error' => 'No Data Found']);
        }
        echo $output;
     }
}
