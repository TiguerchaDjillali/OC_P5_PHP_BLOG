<?php


namespace OpenFram\Form;


use function OpenFram\h;

class SelectField extends Field
{
    protected $options = [];


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
        $widget .= "<select class=\"form-control valid\"";
        foreach($this->attributes as $attribute=>$value){
            $widget .= $attribute . ' = "' . $value . '" ';
        }

        $widget .= ">";
        $widget .= "<option disabled  selected >--- Choisir une role ---</option>";
        foreach($this->options as $key=>$value){

            $widget .= "<option value=\"" . h($key). "\">". h($value) ."</option>";
        }

		$widget .= "</select>";



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

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }


}