<?php

require_once 'kernel/common/template.php';

abstract class owForm extends owFormContainer
{
    const FORM_GET_METHOD = 'get';
    const FORM_POST_METHOD = 'post';

    var $tpl;

    abstract function init();

    function __construct($options=array())
    {
        $this->setDefaultOption($options, 'method', self::FORM_GET_METHOD);
        parent::__construct($options);
        $form_html_attributes = array('onreset', 'onsubmit', 'action', 'name', 'method', 'accept', 'accept-charset', 'enctype');
        $this->available_html_attributes = array_merge($this->available_html_attributes, $form_html_attributes);
        $this->tpl = eZTemplate::factory();
        $this->init();
        $this->initButtons();
        if ($this->isMultipartForm())
        {
            $this->options['enctype'] = 'multipart/form-data';
        }
    }

    function render()
    {
        $submittedButton = $this->getSubmittedButton();
        if ($submittedButton)
        {
            foreach ($this->getSubmittedData() as $input)
            {
                $input->setValueFromRequest();
            }
            $this->validate();
            if ($this->isValid())
            {
                $this->submit();
                return $submittedButton->renderSubmit();
            }
            else
            {
                $this->tpl->setVariable('errors', $this->errors);
                return $this->renderForm();
            }
        }
        else
        {
            return $this->renderForm();
        }
    }

    public function renderForm()
    {
        $this->tpl->setVariable('form', $this);
        return $this->tpl->fetch( "design:owmoduleforms/form.tpl" );
    }

    public function getTemplate()
    {
        return $this->tpl;
    }

    function initButtons()
    {
        $buttons_group = new owFormContainer(array('class' => 'buttonblock block float-break'));
        $buttons_group->addFormElement(new owFormSubmit());
        $buttons_group->addFormElement(new owFormSubmit(array('name' => 'cancel', 'label' => 'Cancel')));
        $this->addFormElement($buttons_group);
    }

    function getFormMethod()
    {
        return $this->getOption('method');
    }

    function getFormTemplate()
    {
        return $this->tpl;
    }

}

?>