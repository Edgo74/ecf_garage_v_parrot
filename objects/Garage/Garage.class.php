<?php

class Garage
{
    private $id;
    private $adresse;
    private $numero;


    public function __construct($id, $adresse, $numero)
    {
        $this->id = $id;
        $this->adresse = $adresse;
        $this->numero = $numero;
    }

    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;

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
