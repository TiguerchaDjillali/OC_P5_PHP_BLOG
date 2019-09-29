<?php


namespace Entity;


use OpenFram\Entity;

class User extends Entity
{
    protected $firstName;
    protected $lastName;
    protected $userName;
    protected $email;
    protected $logoUrl;
    protected $password;
    protected $hashedPassword;
    protected $role;



    public function isValid()
    {
        //TODO:
        return true;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        if(is_string($firstName)){
        $this->firstName = $firstName;
        }
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        if(is_string($lastName)){
            $this->lastName = $lastName;
        }
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
    public function setUserName($userName)
    {
        if(is_string($userName)){
        $this->userName = $userName;
        }
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        //TODO: Validation
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getHashedPassword()
    {
        return $this->hashedPassword;
    }

    /**
     * @param $password
     */
    public function setHashedPassword()
    {
        $this->hashedPassword = password_hash($this->password, PASSWORD_BCRYPT) ;
    }


    public function verifyPassword($password) {
        return password_verify($password, $this->hashedPassword);
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole(Role $role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getLogoUrl()
    {
        return $this->logoUrl;
    }

    /**
     * @param mixed $logoUrl
     */
    public function setLogoUrl($logoUrl)
    {
        $this->logoUrl = $logoUrl;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }



}