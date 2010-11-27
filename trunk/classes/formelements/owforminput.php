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
        $this->value = $this->getOption('default');
    }

    function getSubmittedButton()
    {
        return false;
    }

    function getValue()
    {
        return $this->value;
    }

    function setValueFromRequest($http_method)
    {
        $this->value = (owForm::FORM_GET_METHOD == $http_method) ? $this->http->getVariable($this->getName(), false) : $this->http->variable($this->getName(), false);
    }

    function checkRequired()
    {
        $this->value = $this->getValue();
        if ($this->isRequired() && !$this->value)
        {
            $this->addRequiredError();
        }
    }

    function getInputElements()
    {
        return $this;
    }

}

?>