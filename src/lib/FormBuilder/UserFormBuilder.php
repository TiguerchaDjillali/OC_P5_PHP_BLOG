<?php


namespace FormBuilder;


use OpenFram\Form\FormBuilder;
use OpenFram\Form\InputField;
use OpenFram\Form\InputFileField;
use OpenFram\Form\SelectField;
use OpenFram\Form\TextAreaField;
use OpenFram\Form\Validators\HasLength;
use OpenFram\Form\Validators\HasValidEmailFormat;
use OpenFram\Form\Validators\IsImage;
use OpenFram\Form\Validators\IsNotBlank;

class UserFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(
            new InputFileField([
                'label' => 'Image de mise en avant',
                'attributes' => [
                    'name' => 'profileImage',
                    'type' => 'file',
                ],
                'validators' => [
                    new IsImage("Le fichier n'est pas une image")
                ]
            ]))->add(
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
                    new HasLength('Le champ doit avoir  entre 2 et 255 caractères',
                        ['min' => 2, 'max' => 255]),
                ]
            ]))->add(new InputField([
            'openingGroupTags' => '<div class="col-md-6">',
            'closingGroupTags' => '</div></div>',
            'label' => 'Votre Nom',
            'attributes' => [
                'name' => 'lastName',
                'type' => 'text',
                'maxlength' => '255',
                'minlength' => '2'
            ],
            'validators' => [
                new IsNotBlank('Ce champs est obligatoire'),
                new HasLength('Le champ doit avoir  entre 2 et 255 caractères',
                    ['min' => 2, 'max' => 255]),
            ]
        ]))->add(new InputField([
            'label' => 'Votre Pseudo',
            'attributes' => [
                'name' => 'userName',
                'type' => 'text',
                'maxlength' => '255',
                'minlength' => '2'
            ],
            'validators' => [
                new IsNotBlank('Ce champs est obligatoire'),
                new HasLength('Le champ doit avoir  entre 2 et 255 caractères',
                    ['min' => 2, 'max' => 255]),
            ]
        ]))->add(new SelectField([
            'attributes' => [
                'name' => 'role'

        ]]))->add(
        new InputField([
            'openingGroupTags' => '<div class="row"><div class="col-md-6">',
            'closingGroupTags' => '</div>',
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
        ]))->add(new InputField([
        'openingGroupTags' => '<div class="col-md-6">',
        'closingGroupTags' => '</div></div>',
        'label' => 'Confirmez votre Email',
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
                'openingGroupTags' => '<div class="row"><div class="col-md-6">',
                'closingGroupTags' => '</div>',
                'label' => 'Mot de passe',
                'attributes' => [
                    'name' => 'password',
                    'type' => 'text',
                    'maxlength' => '255',
                    'minlength' => '2'
                ],
                'validators' => [
                    new IsNotBlank('Ce champs est obligatoire'),
                    new HasLength('Le champ doit avoir  entre 2 et 255 caractères',
                        ['min' => 2, 'max' => 255]),
                ]
            ]))->add(new InputField([
            'openingGroupTags' => '<div class="col-md-6">',
            'closingGroupTags' => '</div></div>',
            'label' => 'Confirmer le mot de passe',
            'attributes' => [
                'name' => 'confirmPassword',
                'type' => 'text',
                'maxlength' => '255',
                'minlength' => '2'
            ],
            'validators' => [
                new IsNotBlank('Ce champs est obligatoire'),
                new HasLength('Le champ doit avoir  entre 2 et 255 caractères',
                    ['min' => 2, 'max' => 255]),
            ]
        ]))->add(
            new TextAreaField([
                'label' => 'Description',
                'attributes' => [
                    'name' => 'description',
                ],
                'validators' => [
                    new IsNotBlank('Ce champs est obligatoire'),
                    new HasLength('Le commentaire doit avoir au minimum 20 caractères', ['min' => 2])
                ]
            ]));
    }

}