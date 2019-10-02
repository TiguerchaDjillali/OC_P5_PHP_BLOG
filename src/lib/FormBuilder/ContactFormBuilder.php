<?php


namespace FormBuilder;


use OpenFram\Form\FormBuilder;
use OpenFram\Form\InputTextField;
use OpenFram\Form\NotNullValidator;
use OpenFram\Form\TextAreaField;

class ContactFormBuilder extends FormBuilder
{

    public function build()
    {
        // TODO: Implement build() method.
        $this->form->add(
            new InputTextField([
                'openingGroupTags' => '<div class="row"><div class="col-md-6">',
                'closingGroupTags' => '</div>',
                'label' => 'Votre prénom',
                'name' => 'firstName',
                'validators' => [
                    new NotNullValidator('Le champ nom ne doit pas etre null')
                ]
            ]))->add(
            new InputTextField([
                'openingGroupTags' => '<div class="col-md-6">',
                'closingGroupTags' => '</div></div>',
                'label' => 'Votre Email',
                'name' => 'mail',
                'validators' => [
                    new NotNullValidator('Le champ nom ne doit pas etre null')
                ]
            ]))->add(
            new TextAreaField([
                'label' => 'Votre message',
                'name' => 'message',
                'rows' => 7,
                'cols' => 50,
                'validators' =>[
                    new NotNullValidator('Le message ne doit pas etre null')
                ]
            ] ));
    }
}