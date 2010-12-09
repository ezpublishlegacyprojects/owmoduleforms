<?php

abstract class owFormElement
{
    var $available_html_attributes;
    var $errors;
    var $options;

    public function __construct($options)
    {
        $this->available_html_attributes = array('accesskey', 'class', 'dir', 'id', 'lang', 'style', 'tabindex', 'title', 'xml:lang');
        $this->options = $options;
        $this->errors = array();
    }

    public function addError($error)
    {
        $this->errors[] = $error;
    }

    public function addRequiredError()
    {
        $this->addError(' is required');
    }

    public function attribute( $attribute_name )
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

    public function attributes()
    {
        return array_keys(get_class_vars(get_class($this)));
    }

    public function checkForRequiredOption($required_option, $options)
    {
        if (!array_key_exists($required_option, $options))
        {
            eZDebug::writeError('"' . $required_option . '" is a required option for ' . get_class($this). ' element!');
        }
    }

    public abstract function checkRequired();

    public function getLabel()
    {
        return $this->getOption('label');
    }

    public function getName()
    {
        return $this->getOption('name');
    }

    public function getOption($option_name)
    {
        return $this->isOptionDefined($option_name) ? $this->options[$option_name] : false;
    }

    public function getSubmittedData()
    {
        return array();
    }

    public function hasAttribute( $attribute_name )
    {
        return in_array( $attribute_name, $this->attributes() );
    }

    public function isMultipartForm()
    {
        return false;
    }

    public function isOptionDefined($option_name)
    {
        return array_key_exists($option_name, $this->options);
    }

    public function isRequired()
    {
        return $this->getOption('required');
    }

    public function isValid()
    {
        return empty($this->errors);
    }

    public function processSubmit()
    {
        //do nothing
    }

    public function removeAvailableAttribute($attribute)
    {
        $position = array_search('id', $this->available_html_attributes);
        unset($this->available_html_attributes[$position]);
    }

    public function setDefaultOption(&$options, $default_option, $default_value)
    {
        if (!array_key_exists($default_option, $options))
        {
            $options[$default_option] = $default_value;
        }
    }

    public function setValueFromRequest($http_method)
    {
        // do nothing
    }

    public function validate($http_method)
    {
        $validations = $this->getOption('validation');
        if ($validations)
        {
            foreach ($validations as $validator_class_name => $params)
            {
                $validation_response = ezjscOwFormServerFunctions::callValidator($validator_class_name, $this->getValue(), $params);
                if ($validation_response)
                {
                    $this->addError($validation_response);
                }
            }
        }
    }

}

?>