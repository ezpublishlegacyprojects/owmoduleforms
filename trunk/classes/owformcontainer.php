<?php

class owFormContainer extends owFormElement
{
    var $form_elements;

    public function __construct($options=array())
    {
        parent::__construct($options);
        $html_container_attributes = array(
            'onclick', 'ondblclick', 'onmousedown', 'onmousemove', 'onmouseout',
            'onmouseover', 'onmouseup', 'onkeydown', 'onkeypress', 'onkeyup'
            );
            $this->available_html_attributes = array_merge($this->available_html_attributes, $html_container_attributes);
            $this->form_elements = array();
    }

    function addFormElement($element)
    {
        if ($element instanceof owFormElement)
        {
            $element->setParentFormElement($this);
            $this->form_elements[] = $element;
        }
        else
        {
            //TODO deal with exceptions
        }
    }

    function getSubmittedButton()
    {
        foreach ($this->form_elements as $element)
        {
            if ( $button = $element->getSubmittedButton())
            {
                return $button;
            }
        }
        return false;
    }

    function validateChildren()
    {
        $is_empty = $this->isRequired();

        foreach ($this->form_elements as $element)
        {
            $element->validate();
            if ( $is_empty && $element->getValue())
            {
                $is_empty = false;
            }
            foreach ($element->errors as $error)
            {
                $this->addError($error);
            }
        }
        if ($is_empty)
        {
            $this->addRequiredError();
        }
    }

    function children()
    {
        return $this->form_elements;
    }

}

?>