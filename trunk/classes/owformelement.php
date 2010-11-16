<?php

abstract class owFormElement
{
    var $errors;
    var $parent_form_element;
    var $options;

    public function __construct($options)
    {
        $this->options = $options;
        $this->errors = array();
        $this->setParentFormElement(false);
    }

    function isOptionDefined($option_name)
    {
        return array_key_exists($option_name, $this->options);
    }

    function getOption($option_name)
    {
        return $this->isOptionDefined($option_name) ? $this->options[$option_name] : false;
    }

    function setParentFormElement($form_element)
    {
        $this->parent_form_element = $form_element;
    }

    function attributes()
    {
        return array_keys(get_class_vars(get_class($this)));
    }

    function hasAttribute( $attribute_name )
    {
        return in_array( $attribute_name, $this->attributes() );
    }

    function attribute( $attribute_name )
    {
        if ( $this->hasAttribute($attribute_name))
        {
            return $this->$attribute_name;
        }
        else
        {
            //TODO deal with exceptions
        }
    }

    function getFormMethod()
    {
        return $this->parent_form_element->getFormMethod();
    }

    function getFormTemplate()
    {
        return $this->parent_form_element->getFormTemplate();
    }

    function isValid()
    {
        return empty($this->errors);
    }

    function addError($error)
    {
        $this->errors[] = $error;
    }

    function getName()
    {
        return $this->getOption('name');
    }

    function isRequired()
    {
        return $this->getOption('required');
    }

    function setDefaultOption(&$options, $default_option, $default_value)
    {
        if (!array_key_exists($default_option, $options))
        {
            $options[$default_option] = $default_value;
        }
    }

}

?>