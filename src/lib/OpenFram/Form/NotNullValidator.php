<?php


namespace OpenFram\Form;


class NotNullValidator extends Validator
{

    public function isValid($value)
    {
        // TODO: Implement isValid() method.
        return $value != '';
    }
}