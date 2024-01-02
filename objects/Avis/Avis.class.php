<?php 

class Avis{
    private $id;
    private $nom;
    private $commentaire;
    public $note;
    public $estValide;

    public function __construct($id, $nom, $commentaire,$note, $estValide )
    {
        $this->id = $id;
        $this->nom =  $nom;
        $this->commentaire = $commentaire;
        $this->note =  $note;
        $this->estValide = $estValide;
    }

    public function getId(){return $this->id;}
    public function getNom(){return $this->nom;}
    public function getCommentaire(){return $this->commentaire;}
    public function getNote(){return $this->note;}
    public function getAvisValide(){return $this->estValide;}

    public function setId($id){$this->id = $id;}
    public function setNom($nom){$this->nom = $nom;}
    public function setCommetaire($commentaire){$this->commentaire = $commentaire;}
    public function setNote($note){$this->note = $note;}
    public function setAvisValide($estValide){$this->estValide = $estValide;}

}   