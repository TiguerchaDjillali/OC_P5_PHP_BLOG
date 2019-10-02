<?php


namespace OpenFram\Form;


class InputTextField extends Field
{
    protected $maxLength;

    public function buildWidget()
    {
        $widget = '';


        $widget .= $this->getOpeningGroupTags();
        $widget .= '<div class="form-group">';
        $widget .= '<label id="$this->name" class="bmd-label-floating">' . $this->label . '</label > ';
        $widget .= '<input type="text" name="' . $this->name . '"   id="'.$this->name.'" ';
        $widget .= ' class="form-control" ';
        if(!empty($this->value)){
            $widget .= ' value="'.htmlspecialchars($this->value).'" ';
        }

        if(!empty($this->maxLength)){
            $widget .=' maxlength="'.$this->maxLength.'" ';
        }

        $widget .= '/> ';

        if (!empty($this->errorMessage)) {
            $widget .= '<small class = "text-danger"> * '.$this->errorMessage . '</small></div>';
        }
        $widget.= '</div>';

        $widget .= $this->getClosingGroupTags();

        return $widget;
    }

    /**
     * @param mixed $maxLength
     */
    public function setMaxLength($maxLength)
    {
        $maxLength = (int) $maxLength;
        if($maxLength > 0){
            $this->maxLength = $maxLength;
        }else {
            throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à zéro ');
        }

    }
}