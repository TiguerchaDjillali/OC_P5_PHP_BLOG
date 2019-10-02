<?php


namespace FormBuilder;


use OpenFram\Form\FormBuilder;
use OpenFram\Form\InputField;
use OpenFram\Form\InputTextField;
use OpenFram\Form\NotNullValidator;
use OpenFram\Form\TextAreaField;

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
                'name' => 'firstName',
                'type' => 'text',
                'maxlength' => '250',
                'minlength' => '2',
                'validators' => [
                    new NotNullValidator('Le champ nom ne doit pas etre null')
                ]
            ]))->add( new InputField([
                'openingGroupTags' => '<div class="col-md-6">',
                'closingGroupTags' => '</div></div>',
                'label' => 'Votre Email',
                'type' => 'email',
                'name' => 'email',
                'pattern'=>'\'/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i\'',
                'validators' => [
                    new NotNullValidator('Le champ nom ne doit pas etre null')
                ]
            ]))->add(
            new InputField([
                'label' => 'Objet',
                'name' => 'object',
                'type' => 'text',
                'maxlength' => '250',
                'minlength' => '2',
                'validators' => [
                    new NotNullValidator('Le champ Objet ne doit pas etre null')
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