<?php

class owFormCheckbox extends owFormInput
{

    public function __construct($options=array())
    {
        $this->checkForRequiredOption('values', $options);
        parent::__construct($options);
        $this->removeAvailableAttribute('id');
        $this->removeAvailableAttribute('name');
    }

}

?>