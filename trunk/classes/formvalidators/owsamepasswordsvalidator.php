<?php

class owSamePasswordsValidator extends owFormValidator
{

    public function getErrorMessage()
    {
        return ' the two passwords are not same';
    }

    public function validate()
    {
        $input_values_to_compare = array();
        foreach ($this->input_value as $name => $value)
        {
            if (in_array($name, array_keys($this->getParams())))
            {
                $input_values_to_compare[$value] = true;
            }
        }
        return count($input_values_to_compare) == 1;
    }

}

?>