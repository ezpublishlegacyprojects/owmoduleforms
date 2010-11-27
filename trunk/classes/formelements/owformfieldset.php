<?php

class owFormFieldset extends owFormContainer
{

    function __construct($options=array())
    {
        parent::__construct($options);
        $html_fieldset_attributes = array(
            'onclick', 'ondblclick', 'onmousedown', 'onmousemove', 'onmouseout',
            'onmouseover', 'onmouseup', 'onkeydown', 'onkeypress', 'onkeyup',
        );

        $this->available_html_attributes = array_merge($this->available_html_attributes, $html_fieldset_attributes);
    }

}

?>