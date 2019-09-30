<?php


namespace OpenFram\Form;


use OpenFram\Entity;

abstract class FormBuilder
{
    protected $form;

    /**
     * FormBuilder constructor.
     * @param Entity $entity
     */
    public function __construct(Entity $entity)
    {
        $this->setFrom(new Form($entity));
    }

    abstract public function build();


    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->form;
    }

    /**
     * @param Form $form
     */
    public function setFrom(Form $form)
    {
        $this->form = $form;
    }

}