<?php

class owFormImage extends owFormInput
{

    var $type='image';
    
    public function __construct($options=array())
    {
        $this->checkForRequiredOption('src', $options);
        parent::__construct($options);
        $this->available_html_attributes = array_merge($this->available_html_attributes, array('alt'));
    }
}

?>