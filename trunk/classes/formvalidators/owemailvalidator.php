<?php

class owEmailValidator extends owFormValidator
{

    public function getErrorMessage()
    {
        return ' is not a valid email';
    }

    public function validate()
    {
        return eZMail::validate($this->input_value) ;
    }

}

?>