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

    function validate()
    {
        $this->validateChildren();
        $this->selfValidate();
    }

    function validateCustom($validation_params)
    {
        $validator_class_name = array_key_exists('name', $validation_params) ? $validation_params['name'] : false;
        $validator_params = array_key_exists('params', $validation_params) ? $validation_params['params'] : array();
        if ($validator_class_name)
        {
            try
            {
                $reflection = new ReflectionClass($validator_class_name);
                $customValidator = $reflection->newInstance($this, $validator_params);
                if (!$customValidator->validate())
                {
                    $error = $this->getName() . $customValidator->getErrorMessage();
                    $this->addError($error);
                }
            }
            catch (Exception $e)
            {
                eZDebug::writeError('custom validator class ' . $validator_class_name. ' does not exist');
            }
        }
        else
        {
            eZDebug::writeError('unable to find custom validator class');
        }
    }

    function selfValidate()
    {
        $validation_methods = $this->getOption('validation');
        if ($validation_methods)
        {
            foreach ($validation_methods as $index => $validation_method)
            {
                if (is_array($validation_method))
                {
                    $method_name = $index;
                    $validation_params = $validation_method;
                }
                else
                {
                    $method_name = $validation_method;
                    $validation_params = array();
                }

                switch($method_name)
                {
                    case 'email' :
                        $this->validateEmail();
                        break;
                    case 'integer' :
                        $this->validateNumeric('integer', $validation_params);
                        break;
                    case 'float' :
                        $this->validateNumeric('float', $validation_params);
                        break;
                    case 'alpha' :
                        $this->validateAlphanumericString();
                        break;
                    case 'custom' :
                        $this->validateCustom($validation_params);
                        break;
                }
            }
        }
    }

}

?>