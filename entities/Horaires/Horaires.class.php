
<?php

class Horaires
{
    private $horaire_id;
    private $jour;
    private $debut_heures_AM;
    private $fin_heures_AM;
    private $debut_heures_PM;
    private $fin_heures_PM;
    private $est_ouvert;

    public function __construct($horaire_id, $jour, $debut_heures_AM, $fin_heures_AM, $debut_heures_PM, $fin_heures_PM, $est_ouvert)
    {
        $this->horaire_id = $horaire_id;
        $this->jour = $jour;
        $this->debut_heures_AM = $debut_heures_AM;;
        $this->fin_heures_AM = $fin_heures_AM;
        $this->debut_heures_PM = $debut_heures_PM;
        $this->fin_heures_PM = $fin_heures_PM;
        $this->est_ouvert = $est_ouvert;
    }

    public function getId()
    {
        return $this->horaire_id;
    }
    public function getJour()
    {
        return $this->jour;
    }
    public function getDebutHeure_AM()
    {
        return $this->debut_heures_AM;
    }
    public function getFinHeure_AM()
    {
        return $this->fin_heures_AM;
    }
    public function getDebutHeure_PM()
    {
        return $this->debut_heures_PM;
    }
    public function getFinHeure_PM()
    {
        return $this->fin_heures_PM;
    }
    public function getStatut()
    {
        return $this->est_ouvert;
    }

    public function setId($horaire_id)
    {
        $this->horaire_id = $horaire_id;
    }
    public function setJour($jour)
    {
        $this->jour = $jour;
    }
    public function setDebutHeure_AM($debut_heures_AM)
    {
        $this->debut_heures_AM = $debut_heures_AM;
    }
    public function setFinHeure_AM($fin_heures_AM)
    {
        $this->fin_heures_AM = $fin_heures_AM;
    }
    public function setDebutHeure_PM($debut_heures_PM)
    {
        $this->debut_heures_PM = $debut_heures_PM;
    }
    public function setFinHeure_PM($fin_heures_PM)
    {
        $this->fin_heures_PM = $fin_heures_PM;
    }
    public function setOuvert($est_ouvert)
    {
        $this->est_ouvert = $est_ouvert;
    }
}
