<?php


namespace Entity;


use OpenFram\Entity;

/**
 * Class User
 *
 * @package Entity
 */
class User extends Entity
{
    /**
     * @var
     */
    protected $firstName;
    /**
     * @var
     */
    protected $lastName;
    /**
     * @var
     */
    protected $userName;
    /**
     * @var
     */
    protected $email;
    /**
     * @var
     */
    protected $confirmEmail;
    /**
     * @var null
     */
    protected $profileImage = null;
    /**
     * @var
     */
    protected $password;
    /**
     * @var
     */
    protected $confirmPassword;
    /**
     * @var bool
     */
    protected $passwordRequired = true;
    /**
     * @var
     */
    protected $hashedPassword;
    /**
     * @var
     */
    protected $role;
    /**
     * @var
     */
    protected $description;


    /**
     * @return bool
     */
    public function isValid()
    {
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
        if(is_string($firstName)) {
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
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        if(is_string($lastName)) {
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
        if(is_string($userName)) {
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
        $this->hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);
    }


    /**
     * @param  $password
     * @return bool
     */
    public function verifyPassword($password)
    {
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
    public function getProfileImage()
    {
        return $this->profileImage;
    }

    /**
     * @param mixed $logoUrl
     */
    public function setProfileImage($profileImage)
    {
        $this->profileImage = $profileImage;
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

    /**
     * @return mixed
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    /**
     * @param mixed $confirmPassword
     */
    public function setConfirmPassword($confirmPassword): void
    {
        $this->confirmPassword = $confirmPassword;
    }

    /**
     * @return mixed
     */
    public function getConfirmEmail()
    {
        return $this->confirmEmail;
    }

    /**
     * @param mixed $confirmEmail
     */
    public function setConfirmEmail($confirmEmail): void
    {
        $this->confirmEmail = $confirmEmail;
    }

    /**
     * @return bool
     */
    public function isPasswordRequired(): bool
    {
        return $this->passwordRequired;
    }

    /**
     * @param bool $passwordRequired
     * @return void
     */
    public function setPasswordRequired(bool $passwordRequired): void
    {
        $this->passwordRequired = $passwordRequired;
    }




}
