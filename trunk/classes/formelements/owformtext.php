<?php

class owFormText extends owFormInput
{

    public function __construct($options=array())
    {
        parent::__construct($options);
        $this->available_html_attributes = array_merge($this->available_html_attributes, array('maxlength', 'readonly'));
    }
}

?>