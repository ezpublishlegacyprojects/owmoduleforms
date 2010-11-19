<?php

class sendToFriendForm extends owForm
{
    function init()
    {
        $firstname = new owFormText(array('name' => 'firstname', 'label' => 'First Name', 'required' => true, 'readonly' => 'readonly'));
        $this->addFormElement($firstname);

        $lastname = new owFormText(array('name' => 'lastname', 'label' => 'Last Name', 'required' => true, 'disabled' => 'disabled'));
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

        $username = new owFormText(array('name' => 'username', 'label' => 'User Name', 'required' => true, 'maxlength' => 8, 'validation' => array('alpha')));
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

        $password = new owFormPassword(array('name' => 'password', 'label' => 'Password', 'maxlength' => 6));
        $password_again = new owFormPassword(array('name' => 'password_again', 'label' => 'Retype password', 'maxlength' => 6));

        $passwords_options = array(
            'legend' => 'Update your password',
            'validation' => array(
                'custom' => array(
                    'name' => 'samePasswordsValidator',
                )
            ),
            'class' => 'password_container',
        );

        $passwords = new owFormFieldset($passwords_options);
        $passwords->addFormElement($password);
        $passwords->addFormElement($password_again);
        $this->addFormElement($passwords);

        $image = new owFormImage(array('name' => 'imagesubmit', 'src' => 'images/submit.png'));
        $this->addFormElement($image);

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