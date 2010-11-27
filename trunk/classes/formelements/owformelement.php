<?php

abstract class owFormElement
{
    var $errors;
    var $options;
    var $available_html_attributes;

    public function __construct($options)
    {
        $this->available_html_attributes = array('accesskey', 'class', 'dir', 'id', 'lang', 'style', 'tabindex', 'title', 'xml:lang');
        $this->options = $options;
        $this->errors = array();
    }

    function isOptionDefined($option_name)
    {
        return array_key_exists($option_name, $this->options);
    }

    function getOption($option_name)
    {
        return $this->isOptionDefined($option_name) ? $this->options[$option_name] : false;
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

    function isValid()
    {
        return empty($this->errors);
    }

    function addError($error)
    {
        $this->errors[] = $error;
    }

    function addRequiredError()
    {
        $label = $this->isOptionDefined('label') ? $this->getLabel() : $this->getName();
        $this->addError($label . ' is required');
    }

    function getName()
    {
        return $this->getOption('name');
    }

    function getLabel()
    {
        return $this->getOption('label');
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

    abstract function checkRequired();

    function setValueFromRequest($http_method)
    {
        // do nothing
    }

    function validate($http_method)
    {
        $validations = $this->getOption('validation');
        if ($validations)
        {
            foreach ($validations as $validator_class_name => $params)
            {
                try
                {
                    $reflection = new ReflectionClass($validator_class_name);
                    $customValidator = $reflection->newInstance($this, $params);
                    if (!$customValidator->validate())
                    {
                        $output = $this->isOptionDefined('label') ? $this->getLabel() : $this->getName();
                        $error = '"' . $output . '"' . $customValidator->getErrorMessage();
                        $this->addError($error);
                    }
                }
                catch (Exception $e)
                {
                    eZDebug::writeError('form validator class ' . $validator_class_name. ' does not exist');
                }
            }
        }
    }

    function removeAvailableAttribute($attribute)
    {
        $position = array_search('id', $this->available_html_attributes);
        unset($this->available_html_attributes[$position]);
    }

    function checkForRequiredOption($required_option, $options)
    {
        if (!array_key_exists($required_option, $options))
        {
            eZDebug::writeError('"' . $required_option . '" is a required option for ' . get_class($this). ' element!');
        }
    }

    function isMultipartForm()
    {
        return false;
    }

    function getSubmittedData()
    {
        return array();
    }

    function processSubmit()
    {
        //do nothing
    }

}

?>