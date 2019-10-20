<?php


namespace OpenFram\Form;

use OpenFram\Application;
use OpenFram\ApplicationComponent;
use OpenFram\Entity;

abstract class FormBuilder extends ApplicationComponent
{
    protected $form;

    /**
     * FormBuilder constructor.
     * @param Application $app
     * @param Entity $entity
     */
    public function __construct(Application $app, Entity $entity)
    {
        parent::__construct($app);
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
