<?php

abstract class owFormValidator extends eZInputValidator
{

    var $params;

    function __construct($params=array())
    {
        $this->params = $params;
    }

    function isValid($text)
    {
        return eZInputValidator::STATE_ACCEPTED == $this->validate($text);
    }

    abstract function getErrorMessage();

}

?>