<?php

class owFormContainer extends owFormElement
{
    var $form_elements;

    public function __construct($options=array())
    {
        parent::__construct($options);
        $html_container_attributes = array('onclick', 'ondblclick', 'onmousedown', 'onmousemove', 'onmouseout','onmouseover', 'onmouseup', 'onkeydown', 'onkeypress', 'onkeyup');
        $this->available_html_attributes = array_merge($this->available_html_attributes, $html_container_attributes);
        $this->form_elements = array();
    }

    function addFormElement($element)
    {
        if ($element instanceof owFormElement)
        {
            $element->setParentFormElement($this);
            $this->form_elements[] = $element;
            if ($element instanceof owFormFile)
            {
                $form = $this->getMainForm($this);
                $form->options['enctype'] = 'multipart/form-data';
            }
        }
        else
        {
            //TODO deal with exceptions
        }
    }

    function getSubmittedButton()
    {
        foreach ($this->children() as $element)
        {
            if ( $button = $element->getSubmittedButton())
            {
                return $button;
            }
        }
        return false;
    }

    function validate()
    {
        parent::validate();
        foreach ($this->children() as $element)
        {
            $element->validate();
            foreach ($element->errors as $error)
            {
                $this->addError($error);
            }
        }
    }

    function children()
    {
        return $this->form_elements;
    }

    function submit()
    {
        foreach($this->children() as $element)
        {
            $element->submit();
        }
    }

    function checkRequired()
    {
        $is_empty = false;
        if ($this->isRequired())
        {
            $is_empty = true;
            foreach ($this->children() as $element)
            {
                if ($element->getValue())
                {
                    $is_empty=false;
                }
            }
        }
        if ($is_empty)
        {
            $this->addRequiredError();
        }
    }

}

?>