<?php


namespace FormBuilder;


use OpenFram\Form\FormBuilder;
use OpenFram\Form\InputTextField;
use OpenFram\Form\NotNullValidator;
use OpenFram\Form\StringField;
use OpenFram\Form\TextAreaField;

class PostFormBuilder extends FormBuilder
{
    public function build()
    {
        // TODO: Implement build() method.
        $this->form->add(new InputTextField([
                    'label' => 'Titre',
                    'name' => 'title',
                    'maxLength' => 60,
                    'validators' => [
                        new NotNullValidator('Le titre de l\'article ne doit pas etre null')
                    ]
                ]))->add(new TextAreaField([
                'label' => 'Sous-titre',
                'name' => 'subtitle',
                'rows' => 7,
                'cols' => 50,
                'validators' => [
                    new NotNullValidator('Le le sous-titre ne doit pas etre null')
                ]
            ]))->add(new TextAreaField([
                'label' => 'Contenu',
                'name' => 'content',
                'rows' => 7,
                'cols' => 50,
                'validators' => [
                    new NotNullValidator('Le contenu ne doit pas etre null')
                ]
            ]));
    }
}