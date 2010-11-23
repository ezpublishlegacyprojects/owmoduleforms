<?php

class tipAFriendForm extends owForm
{
    function init()
    {
        $name = new owFormText(array('name' => 'name', 'label' => 'Your Name'));
        $this->addFormElement($name);

        $sender_email = new owFormText(array('name' => 'sender_email', 'label' => 'Your email address', 'required' => true));
        $this->addFormElement($sender_email);
        
        $receivers_email = new owFormText(array('name' => 'receivers_email', 'label' => 'Receivers email address', 'required' => true));
        $this->addFormElement($receivers_email);

        $comment = new owFormTextarea(array('name' => 'comment', 'label' => 'Comment', 'cols' => 40, 'rows' => 10));
        $this->addFormElement($comment);
        
        /*$send = new owFormInputButton(array('name' => 'send', 'label' => 'Send'));
        $this->addFormElement($send);*/
    }

    function doProcess()
    {
        //TODO
    }
    
}

$title = ezi18n( 'extension/owmoduleforms', 'Tip a friend' );
$tipAFriendForm = new tipAFriendForm(array('name' => 'sendtofriend', 'method' => 'post', 'title' => $title, 'module' => $Module));
$Module->setTitle($title);

$Result = array();
$Result['layout'] = false;
$Result['content'] = $tipAFriendForm->render();
$Result['path'] = array( array( 'url' => '/owmoduleformssamples/tipafriend/',
                                'text' =>  $title) );

?>