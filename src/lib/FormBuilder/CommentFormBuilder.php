<?php


namespace FormBuilder;

use OpenFram\Form\FormBuilder;
use OpenFram\Form\TextAreaField;
use OpenFram\Form\Validators\HasLength;
use OpenFram\Form\Validators\IsNotBlank;

class CommentFormBuilder extends FormBuilder
{
    public function build()
    {
        // TODO: Implement build() method.
        $this->form->add(
            new TextAreaField([
                'label' => 'Contenu',
                'attributes' => [
                    'name' => 'content',
                    'rows' => '7',
                    'cols' => '50',
                    'minlength' => '20'
                ],
                'validators' => [
                    new IsNotBlank('Ce champs est obligatoire'),
                    new HasLength('Le commentaire doit avoir au minimum 20 caractères', ['min'=>20])
                ]
            ])
        );
    }
}
