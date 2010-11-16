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
        $this->tpl = eZTemplate::factory();
        $this->init();
        $this->initFormButtons();
    }

    function render()
    {
        $submittedButton = $this->getSubmittedButton();
        if ($submittedButton)
        {
            $this->validate();
            if ($this->isValid())
            {
                $submittedButton->process();
                return $submittedButton->renderValidation();
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
        $this->tpl->setVariable('form_elements', $this->form_elements);
        $this->tpl->setVariable('form_options', $this->options);
        return $this->tpl->fetch( "design:owmoduleforms/form.tpl" );
    }

    public function getTemplate()
    {
        return $this->tpl;
    }

    function initFormButtons()
    {
        $buttons_group = new owFormContainer();
        $buttons_group->addFormElement(new owFormSubmit());
        $buttons_group->addFormElement(new owFormSubmit(array('name' => 'cancel')));
        $this->addFormElement($buttons_group);
    }

    function validate()
    {
        parent::validate();
        $this->validateForm();
    }

    function getFormMethod()
    {
        return $this->getOption('method');
    }

    function getFormTemplate()
    {
        return $this->tpl;
    }

    function validateForm()
    {
        /* do nothing
         * must be extended for custom form validation
         */
    }

}

?>