<?php 

Class Voitures{
    private $id;
    private $titre;
    private $year;
    private $carburant;
    private $kilometre;
    private $price;
    private $image;

    public function  __construct($id, $titre, $year, $carburant, $kilometre, $price, $image){
        $this->id = $id;
        $this->titre = $titre;
        $this->year = $year;
        $this->carburant = $carburant;
        $this->kilometre = $kilometre;
        $this->price = $price;
        $this->image = $image;
    }


    public function getId(){return $this->id;}
    public function getTitre(){return $this->titre;}
    public function getYear(){return $this->year;}
    public function getCarburant(){return $this->carburant;}
    public function getKilometre(){return $this->kilometre;}
    public function getPrice(){return $this->price;}
    public function getImage(){return $this->image;}

    public function setId($id){$this->id = $id;}
    public function setTitre($titre){$this->titre = $titre;}
    public function setYear($year){$this->year = $year;}
    public function setCarburant($carburant){$this->carburant = $carburant;}
    public function setKilometre($kilometre){$this->kilometre = $kilometre;}
    public function setPrice($price){$this->price = $price;}
    public function setImage($kilometre){$this->kilometre = $kilometre;}
}