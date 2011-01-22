<?php

class tipAFriendForm extends owForm
{
    function init()
    {
        $prenom = new owFormText(array('name' => 'prenom', 'label' => 'Prénom', 'validation' => array('owMaxLengthValidator' => array('length' => 6))));
        $this->addFormElement($prenom);
        
        $nom = new owFormText(array('name'=> 'nom', 'label'=> 'Nom', 'required' => true));
        $this->addFormElement($nom);
        /*$name = new owFormText(array('name' => 'name', 'label' => 'Your Name', 'validation' => array(
        	'owMaxLengthValidator' => array('length' => 4),
            'owMinLengthValidator' => array('length' => 6))));
        $this->addFormElement($name);
        
        /*$age =  new owFormText(array('name' => 'age', 'label' => 'Your Age', 'validation' => array('owIntegerValidator' => array('max' => 77, 'min' => 7))));
        $this->addFormElement($age);
                
        $sender_email = new owFormText(array('name' => 'sender_email', 'label' => 'Your email address', 'required' => true, 'validation' => array('owEmailValidator' => array())));
        $this->addFormElement($sender_email);

        $receivers_email = new owFormText(array('name' => 'receivers_email', 'label' => 'Receivers email address', 'required' => true));
        $this->addFormElement($receivers_email);

        $comment = new owFormTextarea(array('name' => 'comment', 'label' => 'Comment', 'cols' => 40, 'rows' => 5));
        $this->addFormElement($comment);*/

    }

    function doProcess()
    {
        //do nothing
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