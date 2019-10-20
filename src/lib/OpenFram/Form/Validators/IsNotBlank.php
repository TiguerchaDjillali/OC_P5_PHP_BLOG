<?php


namespace OpenFram\Form\Validators;


class IsNotBlank extends Validator
{

    public function isValid($value)
    {
        return isset($value) && trim($value) !== '';
    }

}