<?php

class sendToFriendForm extends owForm
{
    function init()
    {
        $firstname = new owFormText(array('name' => 'firstname', 'label' => 'First Name', 'required' => true));
        $this->addFormElement($firstname);

        $lastname = new owFormText(array('name' => 'lastname', 'label' => 'Last Name', 'required' => true));
        $this->addFormElement($lastname);

        $age = new owFormText(
            array(
                'name' => 'age',
                'label' => 'Age (integer)',
                'required' => true,
                'validation' => array(
                    'integer' => array(
                        'min' => 7,
                        'max' => 77
                    )
                )
            )
        );
        $this->addFormElement($age);

        $email = new owFormText(
            array(
                'name' => 'email',
                'label' => 'E-mail',
                'required' => true,
                'default_value' => 'james@bond.com',
                'validation' => array('email')
            )
        );
        $this->addFormElement($email);

        $username = new owFormText(array('name' => 'username', 'label' => 'User Name', 'required' => true, 'validation' => array('alpha')));
        $this->addFormElement($username);

        $fruit = new owFormText(
            array(
                'name' => 'fruit',
                'label' => 'Your favorite fruit',
                'validation' => array(
                    'custom' => array(
                        'name' => 'owInArrayValidator',
                        'params' => array(
                            'valid_items' => array('banana', 'apple', 'strawvberry', 'pear')
                        )
                    )
                )
            )
        );
        $this->addFormElement($fruit);

        $password = new owFormPassword(array('name' => 'password', 'label' => 'Password'));
        $this->addFormElement($password);
    }

}

$title = ezi18n( 'extension/owmoduleforms', 'Send to friend test form' );
$sendToFriendForm = new sendToFriendForm(array('name' => 'sendtofriend', 'method' => 'post', 'title' => $title));
$Module->setTitle($title);

$Result = array();
$Result['layout'] = false;
$Result['content'] = $sendToFriendForm->render();
$Result['path'] = array( array( 'url' => '/owformtest/sendtofriend/',
                                'text' =>  $title) );

?>