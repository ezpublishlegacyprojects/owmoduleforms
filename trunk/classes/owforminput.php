<?php

abstract class owFormInput extends owFormElement
{
    var $value;
    var $options;
    var $http;

    public function __construct($options=array())
    {
        $this->checkForRequiredOption('name', $options);
        if (!array_key_exists('id', $options))
        {
            $this->setDefaultOption($options, 'id', $options['name']);
        }
        parent::__construct($options);
        $html_common_input_attributes = array(
            'onblur', 'onchange', 'onclick', 'ondblclick', 'onfocus', 'onmousedown', 'onmousemove', 'onmouseout',
            'onmouseover', 'onmouseup', 'onkeydown', 'onkeypress', 'onkeyup', 'onselect','disabled', 'size', 'name'
        );
        
        $this->available_html_attributes = array_merge($this->available_html_attributes, $html_common_input_attributes);
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

    function checkRequired()
    {
        $this->value = $this->getValue();
        if ($this->isRequired() && !$this->value)
        {
            $this->addRequiredError();
        }
    }

}

?>