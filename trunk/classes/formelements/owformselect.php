<?php

class owFormSelect extends owFormInput
{

    public function __construct($options=array())
    {
        $this->checkForRequiredOption('values', $options);
        parent::__construct($options);
        $this->available_html_attributes = array_merge($this->available_html_attributes, array('multiple'));
        $this->removeAvailableAttribute('name');
    }

}

?>