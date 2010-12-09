<?php

class owMaxLengthValidator extends owFormValidator
{

    public function getErrorMessage()
    {
        return ' must be shorter than '.$this->params['length'].' characters';
    }

    public function validate()
    {
        return strlen($this->input_value) < $this->params['length'];
    }

}

?>