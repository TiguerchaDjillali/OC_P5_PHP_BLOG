<?php


namespace OpenFram\Form\Validators;


class IsImage extends Validator
{

    public function isValid($value = null)
    {
        if($value !== null) {

            return (getimagesize($value->getStream()->getMetaData()["uri"]) !== false);
        }

        return true;
    }
}
