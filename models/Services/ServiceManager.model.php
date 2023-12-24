<?php

require_once("models/MainManager.model.php");
require("objects/Services/Service.class.php");


class ServiceManager extends Model
{

    private $services;

    public function ajoutService($service)
    {
        $this->services[] = $service;
    }

    public function getService()
    {
        return $this->services;
    }

    public function chargementService()
    {
        $req = "SELECT * FROM services";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $nosServices = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        foreach ($nosServices as $service) {
            $s = new Services($service["id"], $service["titre"], $service["description"]);
            $this->ajoutService($s);
        }
    }

    public function getServiceById($id)
    {
        for ($i = 0; $i < count($this->services); $i++) {
            if ((int)$this->services[$i]->getId() === (int)$id) {
                return $this->services[$i];
            }
        }
    }

    public function AjoutServiceBD($titre, $description)
    {
        $req = "INSERT INTO services(titre, description) VALUES(:titre, :description)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
        $stmt->bindValue(":description", $description, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat >  0) {
            $service = new Services($this->getBdd()->lastInsertId(), $titre, $description);
            $this->ajoutService($service);
        }
    }

    public function SupprimeServiceBD($id)
    {
        $req = "DELETE FROM services WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $service = $this->getServiceById($id);
            unset($service);
        }
    }

    public function ModificationServiceBD($titre, $description, $id)
    {
        $req = "UPDATE services SET titre = :titre , description = :description WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
        $stmt->bindValue(":description", $description, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $this->getServiceById($id)->setTitre($titre);
            $this->getServiceById($id)->setDescription($description);
        }
    }


    public function modifier_supprimer_service_BD()
    {
        $id = Securite::SecureHTML($_POST["serviceId"]);
        $stmt = $this->getBdd()->prepare("SELECT * FROM services WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $output = '';
        if ($resultat > 0) {
            $serviceDetails = $stmt->fetch(PDO::FETCH_OBJ);
            $output = json_encode($serviceDetails);
        } else {
            $output = json_encode(['error' => 'No Data Found']);
        }
        echo $output;
    }
}
