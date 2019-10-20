<?php


namespace FormBuilder;


use OpenFram\Form\FormBuilder;
use OpenFram\Form\InputField;
use OpenFram\Form\Validators\HasLength;
use OpenFram\Form\Validators\IsNotBlank;

class LoginFormBuilder extends FormBuilder
{

    public function build()
    {
        $this->form->add(
            new InputField(
                [
                'label' => 'Votre prénom',
                'attributes' => [
                    'name' => 'userName',
                    'type' => 'text',
                    'maxlength' => '255',
                    'minlength' => '2'
                ],
                'validators' => [
                    new IsNotBlank('Ce champs est obligatoire'),
                    new HasLength(
                        'Le champ doit avoir  entre 2 et 255 caractères',
                        ['min' => 2, 'max' => 255]
                    ),
                ]
                ]
            )
        )->add(
            new InputField(
                [
                    'label' => 'Votre prénom',
                    'attributes' => [
                    'name' => 'password',
                    'type' => 'password',
                    'maxlength' => '255',
                    'minlength' => '2'
                    ],
                    'validators' => [
                    new IsNotBlank('Ce champs est obligatoire'),
                    new HasLength(
                        'Le champ doit avoir  entre 2 et 255 caractères',
                        ['min' => 2, 'max' => 255]
                    ),
                    ]
                    ]
            )
        );
    }
}
