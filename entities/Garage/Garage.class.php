<?php

class Garage
{
    private $garage_id;
    private $adresse;
    private $numero;


    public function __construct($garage_id, $adresse, $numero)
    {
        $this->garage_id = $garage_id;
        $this->adresse = $adresse;
        $this->numero = $numero;
    }

    public function getId()
    {
        return $this->garage_id;
    }


    public function setId($garage_id)
    {
        $this->garage_id = $garage_id;

        return $this;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }
    public function getNumero()
    {
        return $this->numero;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }
}
