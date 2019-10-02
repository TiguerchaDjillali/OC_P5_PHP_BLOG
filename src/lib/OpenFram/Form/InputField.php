<?php


namespace OpenFram\Form;


class InputField extends field
{

    protected $autocomplete;
    protected $autofocus;
    protected $disabled;
    protected $form;
    protected $list;
    protected $required;
    protected $tabindex;
    protected $type;
    protected $value;
    protected $minlength;
    protected $maxlength;
    protected $pattern;
    protected $placeholder;
    protected $size;
    protected $checked;
    protected $readonly;
    protected $spellcheck;


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


        $widget .= '<label id="' . $this->name . '" class=" control-label bmd-label-floating">' . $this->label . '</label >';
        $widget .= '<input class="form-control"  id="' . $this->name . '" ';

        // input tag attributes

        $widget .= ' type="' . $this->type . '" ';
        $widget .= ' name="' . $this->name . '" ';
        if (!empty($this->value)) {
            $widget .= ' value="' . htmlspecialchars($this->value) . '" ';
        }

        if (!empty($this->maxlength)) {
            $widget .= ' maxlength="' . $this->maxlength . '" ';
        }
        if (!empty($this->minlength)) {
            $widget .= ' minlength="' . $this->minlength . '" ';
        }
        if (!empty($this->pattern)) {
            $widget .= ' pattern="' . $this->pattern . '" ';
        }
        if (!empty($this->autocomplete)) {
            $widget .= ' autocomplete="' . $this->autocomplete . '" ';
        }
        if (!empty($this->autofocus)) {
            $widget .= ' autofocus="' . $this->autofocus . '" ';
        }

        if (!empty($this->form)) {
            $widget .= ' form="' . $this->form . '" ';
        }
        if (!empty($this->disabled)) {
            $widget .= ' disabled="' . $this->disabled . '" ';
        }
        if (!empty($this->list)) {
            $widget .= ' list="' . $this->list . '" ';
        }
        if (!empty($this->required)) {
            $widget .= ' required="' . $this->required . '" ';
        }
        if (!empty($this->tabindex)) {
            $widget .= ' tabindex="' . $this->tabindex . '" ';
        }

        if (!empty($this->placeholder)) {
            $widget .= ' placeholder="' . $this->placeholder . '" ';
        }
        if (!empty($this->size)) {
            $widget .= ' size="' . $this->size . '" ';
        }
        if (!empty($this->checked)) {
            $widget .= ' checked="' . $this->checked . '" ';
        }
        if (!empty($this->readonly)) {
            $widget .= ' readonly="' . $this->readonly . '" ';
        }
        if (!empty($this->spellcheck)) {
            $widget .= ' spellcheck="' . $this->spellcheck . '" ';
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

    /**
     * @return mixed
     */
    public function getAutocomplete()
    {
        return $this->autocomplete;
    }

    /**
     * @param mixed $autocomplete
     */
    public function setAutocomplete($autocomplete): void
    {
        $this->autocomplete = $autocomplete;
    }

    /**
     * @return mixed
     */
    public function getAutofocus()
    {
        return $this->autofocus;
    }

    /**
     * @param mixed $autofocus
     */
    public function setAutofocus($autofocus): void
    {
        $this->autofocus = $autofocus;
    }

    /**
     * @return mixed
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * @param mixed $disabled
     */
    public function setDisabled($disabled): void
    {
        $this->disabled = $disabled;
    }

    /**
     * @return mixed
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param mixed $form
     */
    public function setForm($form): void
    {
        $this->form = $form;
    }

    /**
     * @return mixed
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @param mixed $list
     */
    public function setList($list): void
    {
        $this->list = $list;
    }


    /**
     * @return mixed
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * @param mixed $required
     */
    public function setRequired($required): void
    {
        $this->required = $required;
    }

    /**
     * @return mixed
     */
    public function getTabindex()
    {
        return $this->tabindex;
    }

    /**
     * @param mixed $tabindex
     */
    public function setTabindex($tabindex): void
    {
        $this->tabindex = $tabindex;
    }

    /**
     * @return mixed
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }


    /**
     * @return mixed
     */
    public function getMinlength()
    {
        return $this->minlength;
    }

    /**
     * @param mixed $minlength
     */
    public function setMinlength($minlength): void
    {
        $this->minlength = $minlength;
    }

    /**
     * @return mixed
     */
    public function getMaxlength()
    {
        return $this->maxlength;
    }

    /**
     * @param mixed $maxlength
     */
    public function setMaxlength($maxlength): void
    {
        $this->maxlength = $maxlength;
    }

    /**
     * @return mixed
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @param mixed $pattern
     */
    public function setPattern($pattern): void
    {
        $this->pattern = $pattern;
    }

    /**
     * @return mixed
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * @param mixed $placeholder
     */
    public function setPlaceholder($placeholder): void
    {
        $this->placeholder = $placeholder;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size): void
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * @param mixed $checked
     */
    public function setChecked($checked): void
    {
        $this->checked = $checked;
    }

    /**
     * @return mixed
     */
    public function getReadonly()
    {
        return $this->readonly;
    }

    /**
     * @param mixed $readonly
     */
    public function setReadonly($readonly): void
    {
        $this->readonly = $readonly;
    }

    /**
     * @return mixed
     */
    public function getSpellcheck(): ?string
    {
        return $this->spellcheck;
    }

    /**
     * @param mixed $spellcheck
     */
    public function setSpellcheck(?string $spellcheck): void
    {
        $this->spellcheck = $spellcheck;
    }


}