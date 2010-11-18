<?php

abstract class owFormValidator
{

    var $form_element;
    var $params;

    function __construct($form_element, $params=array())
    {
        $this->form_element = $form_element;
        $this->params = $params;
    }

    abstract function getErrorMessage();

    abstract function validate();

}

?>