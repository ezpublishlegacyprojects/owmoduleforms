<?php

class sendToFriendForm extends owForm
{
   function init()
   {
      $firstname = new owFormText('firstname', 'First Name', array('required' => true));
      $this->addFormElement($firstname);
      
      $lastname = new owFormText('lastname', 'Last Name', array('required' => true));
      $this->addFormElement($lastname);
      
      $email = new owFormText('email', 'E-mail', array('required' => true, 'default_value' => 'james@bond.com'));
      $this->addFormElement($email);
      
      $username = new owFormText('username', 'User Name', array('required' => true));
      $this->addFormElement($username);
   }
   
} 

$title = ezi18n( 'extension/owmoduleforms', 'Send to friend test form' );
$sendToFriendForm = new sendToFriendForm('sendtofriend', 'post', $title);
$Module->setTitle($title);

$Result = array();
$Result['layout'] = false;
$Result['content'] = $sendToFriendForm->render();
$Result['path'] = array( array( 'url' => '/owformtest/sendtofriend/',
                                'text' =>  $title) );

?>