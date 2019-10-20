<?php


namespace FormBuilder;

use OpenFram\Form\FormBuilder;
use OpenFram\Form\InputField;
use OpenFram\Form\TextAreaField;
use OpenFram\Form\Validators\HasLength;
use OpenFram\Form\Validators\HasValidEmailFormat;
use OpenFram\Form\Validators\IsNotBlank;

class ContactFormBuilder extends FormBuilder
{

    public function build()
    {
        // TODO: Implement build() method.
        $this->form->add(
            new InputField([
                'openingGroupTags' => '<div class="row"><div class="col-md-6">',
                'closingGroupTags' => '</div>',
                'label' => 'Votre prénom',
                'attributes' => [
                    'name' => 'firstName',
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
            ])
        )->add(new InputField([
            'openingGroupTags' => '<div class="col-md-6">',
            'closingGroupTags' => '</div></div>',
            'label' => 'Votre Email',
            'attributes' => [
                'type' => 'email',
                'name' => 'email',
                'pattern' => '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i',
            ],
            'validators' => [
                new IsNotBlank('Ce champs est obligatoire'),
                new HasValidEmailFormat('L\'email doit avoir un format valide')
            ]
            ]))->add(
                new InputField([
                'label' => 'Objet',
                'attributes' => [
                    'name' => 'object',
                    'type' => 'text',
                   // 'required' => 'required',
                    'maxlength' => '255'
                ],
                'validators' => [
                    new IsNotBlank('Ce champs est obligatoire'),
                    new HasLength('Le champ ne doit pas dépasser 255 caractères', ['max' => 255])
                ]
                ])
            )->add(
                new TextAreaField([
                'label' => 'Votre message',
                'attributes' => [
                    'name' => 'message',
                    'rows' => '7',
                    'cols' => '50'
                ],
                'validators' => [
                    new IsNotBlank('Ce champs est obligatoire'),
                    new HasLength('Le champ doit avoir au minimum 20 caractères', ['min' => 20])
                ]
                ])
            );
    }
}
