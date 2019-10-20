<?php


namespace OpenFram\Form\Validators;

class HasLength extends Validator
{

    protected $lengthLimits = [];

    public function __construct($errorMessage, $options = [])
    {
        parent::__construct($errorMessage);

        foreach ($options as $option => $value) {
            $this->lengthLimits[$option] = $value;
        }
    }

    public function isValid($value)
    {
        if (isset($this->lengthLimits['min']) && !$this->hasLengthGreaterThan($value, $this->lengthLimits['min'] - 1)) {
            return false;
        } elseif (isset($this->lengthLimits['max']) && !$this->hasLengthLessThan($value, $this->lengthLimits['max'] + 1)) {
            return false;
        } elseif (isset($this->lengthLimits['exact']) && !$this->hasLengthExactly($value, $this->lengthLimits['exact'])) {
            return false;
        } else {
            return true;
        }
    }

    public function hasLengthGreaterThan($value, $min)
    {
        $length = strlen($value);
        return $length > $min;
    }

    public function hasLengthLessThan($value, $max)
    {
        $length = strlen($value);
        return $length < $max;
    }

    public function hasLengthExactly($value, $exact)
    {
        $length = strlen($value);
        return $length == $exact;
    }
}
