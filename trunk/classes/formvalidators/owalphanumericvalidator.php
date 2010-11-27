<?php

class owAlphaNumericValidator extends owFormValidator
{

    function validate()
    {
        $rule = array('accepted' => '/^[a-zA-Z0-9_]*$/', 'intermediate' => '//');
        $validator = new eZRegExpValidator($rule);
        return eZInputValidator::STATE_ACCEPTED == $validator->validate($this->form_element->getValue());
    }

    function getErrorMessage()
    {
        return ' is not a valid alphanumeric string';
    }

}

?>