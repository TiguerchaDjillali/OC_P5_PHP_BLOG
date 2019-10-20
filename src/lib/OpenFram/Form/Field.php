<?php


namespace OpenFram\Form;

use OpenFram\Form\Validators\Validator;
use OpenFram\Hydrator;

abstract class Field
{
    use Hydrator;

    protected $errorMessage;
    protected $success;
    protected $label;
    protected $value;
    protected $attributes = [];


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

                return  $this->success = false;
            }
        }

        return  $this->success = true;
    }


    /**
     * @return mixed
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel(string $label)
    {
            $this->label = $label;
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
    public function setValue($value): void
    {
        $this->value = $value;
    }






    /**
     * @return array
     */
    public function getValidators(): array
    {
        return $this->validators;
    }

    /**
     * @param array|null $validators
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

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes): void
    {
        foreach ($attributes as $attribute => $value) {
            if (is_string($attribute) && is_string($value)) {
                $this->attributes[$attribute] =  $value;
            }
        }
    }
}
