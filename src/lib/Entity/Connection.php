<?php


namespace Entity;


use OpenFram\Entity;

class Connection extends Entity
{
    protected $userName;
    protected $passWord;


    public function isValid()
    {
        return true;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getPassWord()
    {
        return $this->passWord;
    }

    /**
     * @param mixed $passWord
     */
    public function setPassWord($passWord): void
    {
        $this->passWord = $passWord;
    }



}