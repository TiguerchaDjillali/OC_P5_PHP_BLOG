<?php


namespace OpenFram\Form;


class StringField extends Field
{
    protected $maxLength;

    public function buildWidget()
    {
        $widget = '';

        if (!empty($this->errorMessage)) {
            $widget ='<h2>'. $this->errorMessage . '</h2><br>';
        }


        $widget .= '<div class="form-group floating-label-form-group controls" > ';
        $widget .= '<label >' . $this->label . '</label > ';
        $widget .= '<input type="text" name="' . $this->name . '"  placeholder="' . ucfirst($this->name) . '"  id="'.$this->name.'" ';
        if(!empty($this->value)){
            $widget .= ' value="'.htmlspecialchars($this->value).'" ';
        }
        if(!empty($this->maxLength)){
            $widget .=' maxlength="'.$this->maxLength.'" ';
        }

        $widget .= '/></div>';
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
