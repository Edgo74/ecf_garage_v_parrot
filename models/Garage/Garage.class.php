<?php 

Class Garage{
    
    private $adresse;
    private $numero;


    public function __construct($adresse, $numero){
        $this->adresse = $adresse;
        $this->numero = $numero;
    }

    public function getAdresse(){return $this->adresse;}
    public function getNumero(){return $this->numero;}

    public function setAdresse($adresse){$this->adresse = $adresse;}
    public function setNumero($numero){$this->numero = $numero;}
}