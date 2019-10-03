<?php


namespace OpenFram\Form;


class InputField extends field
{

    public function buildWidget()
    {
        $widget = '';


        $widget .= $this->getOpeningGroupTags();
        $widget .= '<div class="form-group label-floating ';

        if ($this->success === true) {

            $widget .= 'has-success';
        }

        if (!empty($this->errorMessage)) {

            $widget .= 'has-danger';
        }

        $widget .= ' ">';


        $widget .= '<label id="' . $this->attributes['name'] . '" class=" control-label bmd-label-floating">' . $this->label . '</label >';
        $widget .= '<input class="form-control"  id="' . $this->attributes['name'] . '" ';
        if(!empty($this->value)){
            $widget .= 'value ="'. $this->value . '" ';
        }
        // input tag attributes

        foreach($this->attributes as $attribute=>$value){
            $widget .= $attribute . ' = "' . $value . '" ';
        }

        $widget .= '/> ';


        if (!empty($this->errorMessage)) {

            $widget .= '<span class="material-icons form-control-feedback">clear</span>';
            $widget .= '<small class = "text-danger"> * ' . $this->errorMessage . '</small></div>';
        } elseif ($this->success) {

            $widget .= '<span class="form-control-feedback"> <i class="material-icons">done</i></span></div>';

        } else {
            $widget .= '</div>';
        }


        $widget .= $this->getClosingGroupTags();

        return $widget;
    }

}