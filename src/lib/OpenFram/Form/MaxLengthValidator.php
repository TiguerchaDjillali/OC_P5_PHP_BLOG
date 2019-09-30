<?php


namespace OpenFram\Form;


use http\Exception\InvalidArgumentException;
use http\Exception\RuntimeException;

class MaxLengthValidator extends Validator
{
    protected $maxLength;

    /**
     * MaxLengthValidator constructor.
     * @param $errorMessage
     * @param $maxLength
     */
    public function __construct($errorMessage, $maxLength)
    {
        parent::__construct($errorMessage);

        $this->setMaxLength($maxLength);
    }


    public function isValid($value)
    {
        return strlen($value) <= $this->maxLength;
    }


    /**
     * @param mixed $maxLength
     */
    public function setMaxLength($maxLength)
    {
        $maxLength = (int) $maxLength;
        if($maxLength > 0){

        $this->maxLength = $maxLength;
        }else {
            throw new RuntimeException('La longueur maximale doit être un nombre supérieur à zéro');
        }
    }


}