<?php


namespace OpenFram\Form;


use function OpenFram\escape_to_html as h;

class TextAreaField extends Field
{
    protected $cols;
    protected $rows;

    public function buildWidget()
    {
        $widget = '';


        $widget .= '<div class="form-group label-floating ';

        if ($this->success === true) {

            $widget .= 'has-success';
        }

        if (!empty($this->errorMessage)) {

            $widget .= 'has-danger';
        }

        $widget .= ' ">';

        $widget .= '<label id="'. $this->attributes['name'] .'" class="bmd-label-floating">' . $this->label . '</label > ';
        $widget .= '<textarea name="' . $this->attributes['name']. '"  id="'. $this->attributes['name'] .'" class="form-control" ';

        foreach($this->attributes as $attribute=>$value){
            $widget .= $attribute . ' = "' . $value . '" ';
        }

        $widget .= ' />';
        if(!empty($this->value)){
            $widget .= htmlspecialchars($this->value);
        }
        $widget .= '</textarea>';

        if (!empty($this->errorMessage)) {

            $widget .= '<span class="material-icons form-control-feedback">clear</span>';
            $widget .= '<small class = "text-danger"> * ' . $this->errorMessage . '</small></div>';
        } elseif ($this->success) {

            $widget .= '<span class="form-control-feedback"> <i class="material-icons">done</i></span></div>';

        } else {
            $widget .= '</div>';
        }

        return $widget;
    }
}