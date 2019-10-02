<?php


namespace FormBuilder;


use OpenFram\Form\FormBuilder;
use OpenFram\Form\NotNullValidator;
use OpenFram\Form\TextAreaField;

class CommentFormBuilder extends FormBuilder
{
    public function build()
    {
        // TODO: Implement build() method.
        $this->form->add(
            new TextAreaField([
                    'label' => 'Contenu',
                    'name' => 'content',
                    'rows' => 7,
                    'cols' => 50,
                    'validators' =>[
                        new NotNullValidator('Le commentaire ne doit pas etre null')
                    ]
       ] ));
    }
}