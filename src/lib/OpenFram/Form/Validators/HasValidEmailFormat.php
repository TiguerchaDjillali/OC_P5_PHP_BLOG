<?php


namespace OpenFram\Form\Validators;

class HasValidEmailFormat extends Validator
{


    public function isValid($value)
    {
        $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
        return preg_match($email_regex, $value) === 1;
    }
}
