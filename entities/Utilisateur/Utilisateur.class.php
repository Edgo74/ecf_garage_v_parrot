<?php

class Utilisateur
{
    private $utilisateur_id;
    private $password;
    private $mail;
    private $role;

    public function __construct($utilisateur_id, $password, $mail, $role)
    {
        $this->utilisateur_id = $utilisateur_id;
        $this->password = $password;
        $this->mail = $mail;
        $this->role = $role;
    }

    public function getId()
    {
        return $this->utilisateur_id;
    }


    public function setId($utilisateur_id)
    {
        $this->utilisateur_id = $utilisateur_id;

        return $this;
    }



    public function getPassword()
    {
        return $this->password;
    }


    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }


    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
}
