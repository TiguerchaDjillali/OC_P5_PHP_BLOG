<?php


namespace OpenFram\Form;


class TextField extends Field
{
    protected $cols;
    protected $rows;

    public function buildWidget()
    {
        $widget = '';




        $widget .= '<div class="form-group floating-label-form-group controls" > ';
        $widget .= '<label >' . $this->label . '</label > ';
        $widget .= '<textarea name="' . $this->name . '"  placeholder="' . ucfirst($this->name) . '"  id="message" ';
        if(!empty($this->cols)){
            $widget .= ' cols="'.$this->cols.'" ';
        }
        if(!empty($this->rows)){
            $widget .= ' rows="'.$this->rows.'" ';
        }

        $widget .= 'data-validation-required-message="'. $this->errorMessage  .'" ';

        $widget .= ' >';

        if(!empty($this->value)){
            $widget .= htmlspecialchars($this->value) ;
        }
        $widget .= '</textarea></div>';
        if(!empty($this->errorMessage)){
            $widget .= '<small class = "text-danger float-right">'.$this->errorMessage . '</small> </div>';
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

