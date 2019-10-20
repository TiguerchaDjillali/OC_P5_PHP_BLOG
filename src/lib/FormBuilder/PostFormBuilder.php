<?php


namespace FormBuilder;


use OpenFram\Form\FormBuilder;
use OpenFram\Form\InputField;
use OpenFram\Form\InputFileField;
use OpenFram\Form\InputTextField;
use OpenFram\Form\NotNullValidator;
use OpenFram\Form\StringField;
use OpenFram\Form\TextAreaField;
use OpenFram\Form\Validators\HasLength;
use OpenFram\Form\Validators\HasValidEmailFormat;
use OpenFram\Form\Validators\IsImage;
use OpenFram\Form\Validators\IsNotBlank;

class PostFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(
            new InputFileField(
                [
                'label' => 'Image de mise en avant',
                'attributes' => [
                    'name' => 'featuredImage',
                    'type' => 'file',
                ],
                'validators' => [
                    new IsImage("Le fichier n'est pas une image")
                ]
                ]
            )
        )->add(
            new InputField(
                [
                    'label' => 'Titre',
                    'attributes' => [
                    'name' => 'title',
                    'type' => 'text',
                    'required' => ''
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
                        'label' => 'Sous-titre',
                        'attributes' => [
                        'name' => 'subtitle',
                        'type' => 'text',
                        'maxlength' => '600',
                        'minlength' => '2'
                        ],
                        'validators' => [
                        new IsNotBlank('Ce champs est obligatoire'),
                        new HasLength(
                            'Le champ doit avoir  entre 2 et 255 caractères',
                            ['min' => 2, 'max' => 600]
                        ),
                        ]
                        ]
            )
        )->add(
            new TextAreaField(
                [
                        'label' => 'Contenu',
                        'attributes' => [
                        'name' => 'content',
                        'minlength' => '2'
                        ],
                        'validators' => [
                        new IsNotBlank('Ce champs est obligatoire'),
                        new HasLength('Le commentaire doit avoir au minimum 20 caractères', ['min' => 2])
                        ]
                        ]
            )
        );
    }
}
