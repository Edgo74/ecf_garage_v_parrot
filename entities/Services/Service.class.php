<?php

class Services
{

    private $service_id;
    private $titre;
    private $description;


    public function __construct($service_id, $titre, $description)
    {
        $this->service_id = $service_id;
        $this->titre = $titre;
        $this->description = $description;
    }

    public function getId()
    {
        return $this->service_id;
    }
    public function getTitre()
    {
        return $this->titre;
    }
    public function getDescription()
    {
        return $this->description;
    }

    public function setId($service_id)
    {
        $this->service_id = $service_id;
    }
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
}
