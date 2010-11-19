<?php

class owFormCheckbox extends owFormInput
{

    function __construct($options=array())
    {
        $this->checkForRequiredOption('values', $options);
        parent::__construct($options);
        $this->removeAvailableAttribute('id');
    }

}

?>