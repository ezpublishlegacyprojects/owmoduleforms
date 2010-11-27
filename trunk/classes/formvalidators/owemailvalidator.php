<?php

class owEmailValidator extends owFormValidator
{
    
    function validate()
    {
        return eZMail::validate( $this->form_element->getValue() ) ;
    }

    function getErrorMessage()
    {
        return ' is not a valid email';
    }

}

?>