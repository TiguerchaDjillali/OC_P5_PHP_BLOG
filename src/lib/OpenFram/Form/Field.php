<?php


namespace OpenFram\Form;


use OpenFram\Hydrator;

abstract class Field
{
    use Hydrator;

    protected $errorMessage;
    protected $label;
    protected $name;
    protected $value;
    protected $length;
    protected $openingGroupTags = '';
    protected $closingGroupTags = '';
    protected $validators = [];

    public function __construct(array $options = [])
    {
        if (!empty($options)) {
            $this->hydrate($options);
        }
    }

    abstract public function buildWidget();

    public function isValid()
    {
        foreach ($this->validators as $validator) {
            if (!$validator->isValid($this->value)) {
                $this->errorMessage = $validator->getErrorMessage();
                return false;
            }
        }
        return true;
    }


    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        if (is_string($label)) {
            $this->label = $label;
        }
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        if (is_string($name)) {
            $this->name = $name;
        }
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    public function setLength($length)
    {
        $length = (int)$length;

        if ($length > 0) {
            $this->length = $length;
        }
    }


    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        if (is_string($value)) {
            $this->value = $value;
        }
    }

    /**
     * @return array
     */
    public function getValidators(): array
    {
        return $this->validators;
    }

    /**
     * @param array $validators
     */
    public function setValidators(array $validators)
    {
        foreach ($validators as $validator) {
            if ($validator instanceof Validator && !in_array($validator, $this->validators)) {
                $this->validators[] = $validator;
            }
        }
    }

    /**
     * @return string
     */
    public function getOpeningGroupTags(): string
    {
        return $this->openingGroupTags;
    }

    /**
     * @param string $openingGroupTags
     */
    public function setOpeningGroupTags(string $openingGroupTags): void
    {
        $this->openingGroupTags = $openingGroupTags;
    }

    /**
     * @return string
     */
    public function getClosingGroupTags(): string
    {
        return $this->closingGroupTags;
    }

    /**
     * @param string $closingGroupTags
     */
    public function setClosingGroupTags(string $closingGroupTags): void
    {
        $this->closingGroupTags = $closingGroupTags;
    }



}