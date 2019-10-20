<?php


namespace OpenFram\Form;


use GuzzleHttp\Psr7\Request;
use OpenFram\Manager;

class FormHandler
{
    protected $form;
    protected $manager;
    protected $request;

    /**
     * FormHandler constructor.
     *
     * @param $form
     * @param $manager
     * @param $request
     */
    public function __construct(Form $form, Manager $manager,Request $request)
    {
        $this->setForm($form);
        $this->setManager($manager);
        $this->setRequest($request);
    }

    public function process()
    {
        if($this->request->getMethod() == 'POST' && $this->form->isValid()) {
            $this->manager->save($this->form->getEntity());

            return true;
        }
        return false;
    }
    /**
     * @param mixed $form
     */
    public function setForm($form)
    {
        $this->form = $form;
    }

    /**
     * @param mixed $manager
     */
    public function setManager($manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }




}
