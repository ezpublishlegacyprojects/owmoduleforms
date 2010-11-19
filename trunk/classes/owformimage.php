<?php

class owFormImage extends owFormInput
{

    function __construct($options=array())
    {
        if (!array_key_exists('src', $options))
        {
            eZDebug::writeError('src attribute is required for image input!');
        }

        parent::__construct($options);
        $this->available_html_attributes = array_merge($this->available_html_attributes, array('alt'));
    }
}

?>