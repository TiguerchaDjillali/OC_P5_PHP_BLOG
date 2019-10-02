<?php


namespace OpenFram\Form;


class TextAreaField extends Field
{
    protected $cols;
    protected $rows;

    public function buildWidget()
    {
        $widget = '';


        $widget .= '<div class="form-group">';
        $widget .= '<label id=" $this->name">' . $this->label . '</label > ';
        $widget .= '<textarea name="' . $this->name . '"  id="'. $this->name .'" class="form-control" ';

        if(!empty($this->cols)){
            $widget .= 'cols="'.$this->cols.'" ';
        }

        if(!empty($this->rows)){
            $widget .= 'rows="'.$this->rows.'" ';
        }

        $widget .= ' />';
        if(!empty($this->value)){
            $widget .= htmlspecialchars($this->value);
        }
        $widget .= '</textarea>';

        if(!empty($this->errorMessage)){
            $widget .= '<small class = "text-danger"> * '.$this->errorMessage . '</small></div>';
        } else {
            $widget .='</div>';
        }
        return $widget;
    }

    /**
     * @param mixed $cols
     */
    public function setCols($cols)
    {
        $cols = (int) $cols;
        if($cols>0){
            $this->cols = $cols;
        }
    }

    /**
     * @param mixed $rows
     */
    public function setRows($rows)
    {
        $rows = (int) $rows;
        if($rows > 0){
            $this->rows = $rows;
        }
    }

}