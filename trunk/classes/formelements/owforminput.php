<?php

abstract class owFormInput extends owFormElement
{
    var $http;
    var $options;
    var $value;
    var $type = 'input';

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

    public function checkRequired()
    {
        $this->value = $this->getValue();
        if ($this->isRequired() && !$this->value)
        {
            $this->addRequiredError();
        }
    }

    public function getInputElements()
    {
        return $this;
    }

    public function getSubmittedButton()
    {
        return false;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValueFromRequest($http_method)
    {
        $get_variable = $this->http->getVariable($this->getName(), false);
        $post_variable = $this->http->variable($this->getName(), false);
        $http_value = (owForm::FORM_GET_METHOD == $http_method) ? $get_variable : $post_variable;
        $this->value = htmlspecialchars($http_value, ENT_QUOTES);
    }

}

?>