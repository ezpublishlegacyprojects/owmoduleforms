<?php

class owFormTextarea extends owFormInput
{

    public function __construct($options=array())
    {
        $this->checkForRequiredOption('cols', $options);
        $this->checkForRequiredOption('rows', $options);
        parent::__construct($options);
        $this->available_html_attributes = array_merge($this->available_html_attributes, array('cols', 'rows', 'readonly'));
    }
}

?>