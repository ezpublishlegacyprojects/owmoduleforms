<?php

abstract class owFormValidator
{
    var $input_value;
    var $params;

    public function __construct($input_value, $params=array())
    {
        $this->input_value = $input_value;
        $this->params = $params;
    }

    public abstract function getErrorMessage();
    
    public function getParams()
    {
        return $this->params;
    }

    public abstract function validate();
}

?>