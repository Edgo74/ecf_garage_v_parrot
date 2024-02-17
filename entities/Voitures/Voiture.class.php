<?php

class Voitures
{
    private $id;
    private $titre;
    private $year;
    private $carburant;
    private $kilometre;
    private $price;
    private $image;
    private $immatriculation;
    private $type;
    private $date;

    public function  __construct($id, $titre, $year, $carburant, $kilometre, $price, $image, $immatriculation, $type, $date)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->year = $year;
        $this->carburant = $carburant;
        $this->kilometre = $kilometre;
        $this->price = $price;
        $this->image = $image;
        $this->immatriculation = $immatriculation;
        $this->type = $type;
        $this->date = $date;
    }


    public function getId()
    {
        return $this->id;
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



    public function setId($id)
    {
        $this->id = $id;
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
}
