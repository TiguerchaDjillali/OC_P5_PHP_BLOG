<?php


namespace OpenFram\Form\Validators;


abstract class Validator
{
    protected $errorMessage;

    public function __construct($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    abstract public function isValid($value);

    /**
     * @param mixed $errorMessage
     */
    public function setErrorMessage($errorMessage)
    {
        if(is_string($errorMessage)) {
            $this->errorMessage = $errorMessage;
        }
    }

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}
