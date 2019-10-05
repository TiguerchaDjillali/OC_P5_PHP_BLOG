<?php


namespace FormBuilder;


use OpenFram\Form\FormBuilder;
use OpenFram\Form\InputField;
use OpenFram\Form\InputTextField;
use OpenFram\Form\NotNullValidator;
use OpenFram\Form\StringField;
use OpenFram\Form\TextAreaField;
use OpenFram\Form\Validators\HasLength;
use OpenFram\Form\Validators\HasValidEmailFormat;
use OpenFram\Form\Validators\IsNotBlank;

class PostFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(
            new InputField([
                'label' => 'Votre prénom',
                'attributes' => [
                    'name' => 'title',
                    'type' => 'text',
                    'maxlength' => '255',
                    'minlength' => '2'
                ],
                'validators' => [
                    new IsNotBlank('Ce champs est obligatoire'),
                    new HasLength('Le champ doit avoir  entre 2 et 255 caractères',
                        ['min' => 2, 'max' => 255]),
                ]
            ]));
    }
}