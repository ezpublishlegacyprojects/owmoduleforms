<?php

class owAlphaNumericValidator extends owFormValidator
{

    public function getErrorMessage()
    {
        return ' is not a valid alphanumeric string';
    }

    public function validate()
    {
        $rule = array('accepted' => '/^[a-zA-Z0-9_]*$/', 'intermediate' => '//');
        $validator = new eZRegExpValidator($rule);
        return eZInputValidator::STATE_ACCEPTED == $validator->validate($this->input_value);
    }

}

?>