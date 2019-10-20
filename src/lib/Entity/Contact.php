<?php


namespace Entity;

use OpenFram\Entity;

class Contact extends Entity
{
    protected $firstName;
    protected $email;
    protected $object;
    protected $message;

    const FIRST_NAME_INVALID = 1;
    const EMAIL_INVALID= 2;
    const OBJECT_INVALID= 3;
    const MESSAGE_INVALID= 4;

    public function isValid()
    {
        return !(empty($this->firstName) || empty($this->email) || empty($this->message) || empty($this->object));
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
    public function setFirstName($firstName): void
    {
        if (empty($firstName || !is_string($firstName))) {
            $this->errors[] = self::FIRST_NAME_INVALID;
        }
        $this->firstName = $firstName;
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
    public function setEmail($email): void
    {
        if (empty($email || !is_string($email))) {
            $this->errors[] = self::EMAIL_INVALID;
        }
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        if (empty($message || !is_string($message))) {
            $this->errors[] = self::MESSAGE_INVALID;
        }
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param mixed $object
     */
    public function setObject($object): void
    {
        if (empty($object || !is_string($object))) {
            $this->errors[] = self::OBJECT_INVALID;
        }
        $this->object = $object;
    }
}
