<?php

class samePasswordsValidator extends owFormValidator
{

    function validate()
    {
        $passwords = $this->form_element->children();
        return $passwords[0]->getValue() == $passwords[1]->getValue();
    }

    function getErrorMessage()
    {
        return ' the two passwords are not same';
    }

}

?>