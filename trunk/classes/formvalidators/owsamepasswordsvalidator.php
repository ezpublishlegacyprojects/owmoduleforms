<?php

class owSamePasswordsValidator extends owFormValidator
{

    function validate()
    {
        $children = $this->form_element->children();
        $input_values_to_compare = array();
        foreach ($children as $input)
        {
            if (in_array($input->getName(), $this->getParams()))
            {
                $input_values_to_compare[$input->getValue()] = true;
            }
        }
        return count($input_values_to_compare) == 1;
    }

    function getErrorMessage()
    {
        return ' the two passwords are not same';
    }

}

?>