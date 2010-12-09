<?php

require_once 'kernel/common/template.php';

abstract class owForm extends owFormContainer
{
    const FORM_GET_METHOD = 'get';
    const FORM_POST_METHOD = 'post';

    var $http;
    var $ini;
    var $token;
    var $token_form_element;
    var $tpl;
    
    public function __construct($options=array())
    {
        $this->checkForRequiredOption('module', $options);
        $this->setDefaultOption($options, 'method', self::FORM_GET_METHOD);
        parent::__construct($options);
        $form_html_attributes = array('onreset', 'onsubmit', 'action', 'name', 'method', 'accept', 'accept-charset', 'enctype');
        $this->available_html_attributes = array_merge($this->available_html_attributes, $form_html_attributes);
        $this->tpl = eZTemplate::factory();
        $this->http = eZHTTPTool::instance();
        $this->ini = eZIni::instance('owmoduleforms.ini');
        $this->initToken();
        $this->init();
        $this->initButtons();
        if ($this->isMultipartForm())
        {
            $this->options['enctype'] = 'multipart/form-data';
        }
    }

    public abstract function doProcess();

    public function getFormTemplate()
    {
        return $this->tpl;
    }
    
    public function getHttpFormMethod()
    {
        return $this->getOption('method');
    }

    public function getTemplate()
    {
        return $this->tpl;
    }

    public abstract function init();

    private function initToken()
    {
        $tokenTimeToLive = $this->ini->hasVariable( 'FormSettings', 'TokenTimeToLive' ) ?  intval($this->ini->variable( 'FormSettings', 'TokenTimeToLive' )) : 0;
        if ($this->http->sessionVariable('owmoduleforms_token_time') < time() - $tokenTimeToLive)
        {
            $this->token = md5(uniqid(rand(), true));
            $this->http->setSessionVariable('owmoduleforms_token', $this->token);
            $this->http->setSessionVariable('owmoduleforms_token_time', time());
        }
        else
        {
            $this->token = $this->http->sessionVariable('owmoduleforms_token');
        }
        $this->token_form_element = new owFormHidden(array('name' => 'owmoduleforms_token', 'value' => $this->token));
        $this->addFormElement($this->token_form_element);
    }

    private function initButtons()
    {
        $buttons_group = new owFormContainer(array('class' => 'buttonblock block float-break'));
        $buttons_group->addFormElement(new owFormSubmit());
        $buttons_group->addFormElement(new owFormCancel(array('module' => $this->getOption('module'))));
        $this->addFormElement($buttons_group);
    }

    public function render()
    {
        return $this->getSubmittedButton() ? $this->getSubmittedButton()->submit($this) : $this->renderForm();
    }

    public function renderForm()
    {
        $this->tpl->setVariable('form', $this);
        return $this->tpl->fetch( "design:owmoduleforms/form.tpl" );
    }

    public function validate($http_method)
    {
        parent::validate($http_method);
        $token_in_session = $this->http->sessionVariable('owmoduleforms_token');
        $token_time_in_session = $this->http->sessionVariable('owmoduleforms_token_time');
        $token_in_request = $this->token_form_element->getValue();

        if ($token_in_session != $token_in_request)
        {
            $this->addError('Invalid form token');
        }

        $referrer = $_SERVER['HTTP_REFERER'];
        if (!strstr($referrer, eZSys::requestURI()) || !strstr($referrer, eZSys::serverURL()))
        {
            $this->addError('Invalid http referer');
        }
    }

}

?>