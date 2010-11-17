<?php

abstract class owFormInput extends owFormElement
{
    var $value;
    var $options;
    var $http;

    public function __construct($options=array())
    {
        if (!array_key_exists('name', $options))
        {
            eZDebug::writeError('Name is required for input!');
        }
        parent::__construct($options);
        $this->http = eZHTTPTool::instance();
        $this->value = $this->getOption('default_value');
    }

    function getSubmittedButton()
    {
        return false;
    }

    function getValue()
    {
        $method = $this->getFormMethod();
        if (owForm::FORM_GET_METHOD == $method)
        {
            return $this->http->getVariable($this->getName(), false);
        }
        else
        {
            return $this->http->variable($this->getName(), false);
        }
    }

    function validateEmail()
    {
        if (!eZMail::validate( $this->getValue() ) )
        {
            $this->addError($this->getName() . ' is not a valid email');
        }
    }

    function validateNumeric($numeric_type, $validation_params)
    {
        $min = array_key_exists('min', $validation_params) ? $validation_params['min'] : false;
        $max = array_key_exists('max', $validation_params) ? $validation_params['max'] : false;
        $validator = $numeric_type == 'integer' ? new eZIntegerValidator($min, $max) : new eZFloatValidator($min, $max);

        if (eZInputValidator::STATE_ACCEPTED != $validator->validate($this->getValue()))
        {
            if ($min != false && $max != false)
            {
                $error = $this->getName() . ' must be a numeric ('.$numeric_type.') between ' . $min . ' and ' . $max;
            }
            elseif ($min !== false)
            {
                $error = $this->getName() . ' must be a numeric ('.$numeric_type.') greater than ' . $min;
            }
            elseif ($max !== false)
            {
                $error = $this->getName() . ' must be a numeric ('.$numeric_type.') lower than ' . $max;
            }
            else
            {
                $error = $this->getName() . ' is not a valid a numeric ('.$numeric_type.')';
            }
            $this->addError($error);
        }
    }

    function validateAlphanumericString()
    {
        $rule=array('accepted' => '/^[a-zA-Z0-9_]*$/', 'intermediate' => '//');
        $validator = new eZRegExpValidator($rule);
        if (eZInputValidator::STATE_ACCEPTED != $validator->validate($this->getValue()))
        {
            $this->addError($this->getName(). ' is not a valid alphanumeric string');
        }
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
                $customValidator = $reflection->newInstance($validator_params);
                if (!$customValidator->isValid($this->getValue()))
                {
                    $this->addError($this->getName(). $customValidator->getErrorMessage());
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

    function validate()
    {
        $this->value = $this->getValue();
        if ($this->isRequired() && !$this->value)
        {
            $this->addError($this->getName() . ' is not valid');
        }
        elseif ($this->value)
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

}

?>