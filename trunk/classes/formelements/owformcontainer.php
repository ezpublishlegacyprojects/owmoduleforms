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
            $this->form_elements[] = $element;
        }
        else
        {
            eZDebug::writeError('Unable to add element ' . get_class($element));
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

    function validate($http_method)
    {
        foreach ($this->children() as $element)
        {
            $element->setValueFromRequest($http_method);
            $element->checkRequired();
            $element->validate($http_method);
            foreach ($element->errors as $error)
            {
                if (!array_key_exists('children_errors', $this->errors))
                {
                    $this->errors['children_errors'] = array();
                }
                $this->errors['children_errors'][] = $error;
            }
        }
        $this->checkRequired();
        parent::validate($http_method);
    }

    function children()
    {
        return $this->form_elements;
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

    function isMultipartForm()
    {
        foreach ($this->children() as $element)
        {
            if ($element->isMultipartForm())
            {
                return true;
            }
        }
        return false;
    }

    function getSubmittedData()
    {
        $valued_elements = array();
        foreach($this->children() as $child)
        {
            if ($child instanceof owFormInput)
            {
                $valued_elements[] = $child;
            }
            else
            {
                $valued_elements = array_merge($valued_elements, $child->getSubmittedData());
            }
        }
        return $valued_elements;
    }

    function processSubmit()
    {
        foreach ($this->children() as $child)
        {
            $child->processSubmit();
        }
    }
}

?>