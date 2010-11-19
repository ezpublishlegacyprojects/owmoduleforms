<?php

class owFormRadio extends owFormInput
{

    function __construct($options=array())
    {
        unset($this->available_html_attributes['id']);
        if (!array_key_exists('values', $options))
        {
            eZDebug::writeError('values are required for input!');
        }
        else
        {
            parent::__construct($options);
        }
    }

}

?>