<?php

abstract class owNumericValidator extends owFormValidator
{
    var $error;

    public function getErrorMessage()
    {
        return $this->error;
    }
    
    public abstract function getNumericType();
    
    public abstract function getValidator($min=false, $max=false);

    public function validate()
    {
        $params = $this->getParams();
        $min = array_key_exists('min', $params) ? $params['min'] : false;
        $max = array_key_exists('max', $params) ? $params['max'] : false;
        $validator = $this->getValidator($min, $max);
        $numeric_type = $this->getNumericType();
        $isValid = eZInputValidator::STATE_ACCEPTED == $validator->validate($this->input_value);
        
        if (!$isValid)
        {
            if ($min != false && $max != false)
            {
                $this->error = ' must be a numeric ('.$numeric_type.') between ' . $min . ' and ' . $max;
            }
            elseif ($min !== false)
            {
                $this->error = ' must be a numeric ('.$numeric_type.') greater than ' . $min;
            }
            elseif ($max !== false)
            {
                $this->error = ' must be a numeric ('.$numeric_type.') lower than ' . $max;
            }
            else
            {
                $this->error = ' is not a valid a numeric ('.$numeric_type.')';
            }
        }
        return $isValid;
    }

}

?>