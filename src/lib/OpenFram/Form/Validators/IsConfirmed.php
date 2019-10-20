<?php


namespace OpenFram\Form\Validators;


class IsConfirmed extends Validator
{

    protected $fieldToConfirm;

    public function __construct($errorMessage, $fieldToConfirm)
    {
        parent::__construct($errorMessage);
        $this->fieldToConfirm = $fieldToConfirm;

    }

    public function isValid($value)
    {
        return $value === $this->fieldToConfirm;
    }
}
