<?php


namespace OpenFram\Form;


class InputTextField extends Field
{
    protected $maxLength;

    public function buildWidget()
    {
        $widget = '';



        $widget .= '<div>';
        $widget .= '<label id="$this->name">' . $this->label . '</label > ';
        $widget .= '<input type="text" name="' . $this->name . '"   id="'.$this->name.'" ';

        if(!empty($this->value)){
            $widget .= ' value="'.htmlspecialchars($this->value).'" ';
        }

        if(!empty($this->maxLength)){
            $widget .=' maxlength="'.$this->maxLength.'" ';
        }

        $widget .= '/> ';

        if (!empty($this->errorMessage)) {
            $widget .='<small>'. $this->errorMessage . '</small>';
        }
        $widget.= '</div>';



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