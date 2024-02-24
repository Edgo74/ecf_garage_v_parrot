<?php

class Voitures
{
    private $voiture_id;
    private $titre;
    private $year;
    private $carburant;
    private $kilometre;
    private $price;
    private $image;
    private $immatriculation;
    private $type;
    private $date;
    private $garantie;

    public function  __construct($voiture_id, $titre, $year, $carburant, $kilometre, $price, $image, $immatriculation, $type, $date, $garantie)
    {
        $this->voiture_id = $voiture_id;
        $this->titre = $titre;
        $this->year = $year;
        $this->carburant = $carburant;
        $this->kilometre = $kilometre;
        $this->price = $price;
        $this->image = $image;
        $this->immatriculation = $immatriculation;
        $this->type = $type;
        $this->date = $date;
        $this->garantie = $garantie;
    }


    public function getId()
    {
        return $this->voiture_id;
    }
    public function getTitre()
    {
        return $this->titre;
    }
    public function getYear()
    {
        return $this->year;
    }
    public function getCarburant()
    {
        return $this->carburant;
    }
    public function getKilometre()
    {
        return $this->kilometre;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getImage()
    {
        return $this->image;
    }

    public function getImmatriculation()
    {
        return $this->immatriculation;
    }

    public function getType()
    {
        return $this->type;
    }


    public function getDate()
    {
        return $this->date;
    }



    public function setId($voiture_id)
    {
        $this->voiture_id = $voiture_id;
    }
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }
    public function setYear($year)
    {
        $this->year = $year;
    }
    public function setCarburant($carburant)
    {
        $this->carburant = $carburant;
    }
    public function setKilometre($kilometre)
    {
        $this->kilometre = $kilometre;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setImmatriculation($immatriculation)
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of garantie
     */
    public function getGarantie()
    {
        return $this->garantie;
    }

    /**
     * Set the value of garantie
     *
     * @return  self
     */
    public function setGarantie($garantie)
    {
        $this->garantie = $garantie;

        return $this;
    }
}
