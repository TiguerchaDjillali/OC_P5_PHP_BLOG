<?php


namespace OpenFram\Form;


class SelectField extends Field
{


    public function buildWidget()
    {
        $widget = "<select class=\"form-control\" aria-invalid=\"false\">
														<option disabled=\"\" selected=\"\"></option>
	                                                	<option value=\"Afghanistan\"> Afghanistan </option>
	                                                	<option value=\"Albania\"> Albania </option>
		                                        	</select>";
        return $widget;
    }
}