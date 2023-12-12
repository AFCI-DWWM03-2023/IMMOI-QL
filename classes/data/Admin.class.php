<?php

class Admin{
    public function __construct(private $username, private $password)
    {
    }

    public function getUsername()         {return $this->username;}
    public function getPassword()         {return $this->password;}

    public function setUsername($username)         {$this->username = $username;}
    public function setPassword($password)         {$this->password = $password;}

}