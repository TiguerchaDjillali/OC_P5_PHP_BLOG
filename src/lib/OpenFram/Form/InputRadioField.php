<?php


namespace OpenFram\Form;


class InputRadioField extends InputField
{

    protected $options = [];
    protected $checkedRadio;


    public function buildWidget()
    {
        $widget = '';

        $widget .= $this->getOpeningGroupTags();

        $widget .= "<div class=\"form-group\">";
        $widget .= "<div class=\"form-check form-check-radio\">";

        foreach($this->options as $key=>$value){
            $widget .= "<label class=\"form-check-label px-4\">";
            $widget .= "<input type = \"radio\" class=\" form-check-input \" name = \"". $this->attributes["name"] ."\"";
            $widget .=" value = \"". $key."\"";
            if(isset($this->value)){
                if ($this->value->getName() === $value) {
                    $widget .= 'checked';
                }
            }elseif($value === $this->checkedRadio){
                $widget .= 'checked';
            }
            $widget .=">";
            $widget .= $value;

             $widget .= "<span class=\"circle\"><span class=\"check\"></span></span>";
             $widget .= "</label>";
        }



        $widget .= '</div></div>';

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

    /**
     * @return mixed
     */
    public function getCheckedRadio()
    {
        return $this->checkedRadio;
    }

    /**
     * @param mixed $checkedRadio
     */
    public function setCheckedRadio($checkedRadio): void
    {
        $this->checkedRadio = $checkedRadio;
    }



}