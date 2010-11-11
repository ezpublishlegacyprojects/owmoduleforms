<?php

class sendToFriendForm extends owForm
{
   function init()
   {
      $name = new owFormText('firstname', 'First Name');
      $this->addFormElement($name);
   }
   
   function process()
   {
      //do nothing
   }
   
   function displayValidation()
   {
      return 'send to friend successful!';
   }
} 

$sendToFriendForm = new sendToFriendForm('sendtofriend');

$Result = array();
$Result['content'] = $sendToFriendForm->display();
$Result['path'] = array( array( 'url' => '/owformtest/sendtofriend/',
                                'text' => ezi18n( 'extension/owmoduleforms', 'Send to friend test form' ) ) );

?>