<?php

class registerForm extends owForm
{
    function init()
    {
        $firstname = new owFormText(array('name' => 'firstname', 'label' => 'First Name', 'size' => 70));
        $this->addFormElement($firstname);

        $lastname = new owFormText(array('name' => 'lastname', 'label' => 'Last Name', 'size' => 70));
        $this->addFormElement($lastname);

        $user_account = new owFormFieldset(
        array(
                'id' => 'passwords',
                'legend' => 'User account',
                'class' => 'password_container',
                'validation' => array(
                        'owSamePasswordsValidator' => array('password' => 'child', 'password_again' => 'child'),
        )
        )
        );
        $login = new owFormText(array('name' => 'login', 'label'=> 'Login', 'required' => true, 'size' => 16));
        $password = new owFormPassword(array('name' => 'password', 'label' => 'Password', 'required' => true, 'size' => 16));
        $password_again = new owFormPassword(array('name' => 'password_again', 'label' => 'Confirm password', 'size' => 16));
        $email = new owFormText(array('name' => 'email', 'label' => 'E-mail', 'required' => true, 'validation' => array('owEmailValidator' => array())));

        $user_account->addFormElement($login);
        $user_account->addFormElement($password);
        $user_account->addFormElement($password_again);
        $user_account->addFormElement($email);
        $this->addFormElement($user_account);

        $signature = new owFormTextarea(array('name' => 'signature', 'label' => 'Your signature', 'cols' => 70, 'rows' => 10));
        $this->addFormElement($signature);

        $image_group = new owFormFieldset(array('legend' => 'Image'));
        $image_file = new owFormFile(array('name'=> 'image', 'label' => 'New image', 'accept' => 'image/gif, image/jpeg, image/png', 'maxfilesize' => '100000', 'upload_dir_path' => '/var/cache/', 'required' => true));
        $image_alt = new owFormText(array('name' => 'image_alt', 'label' => 'Alternative text'));
        $image_group->addFormElement($image_file);
        $image_group->addFormElement($image_alt);
        $this->addFormElement($image_group);
    }

    function initButtons()
    {
        $submit = new owFormSubmit(array('value' => 'S\'inscrire'));
        $this->addFormElement($submit);
    }

    function doProcess()
    {
        //do nothing
    }

}

$title = ezi18n( 'extension/owmoduleforms', 'Register user form' );
$form = new registerForm(array('name' => 'register', 'method' => 'post', 'title' => $title, 'module' => $Module));
$Module->setTitle($title);

$Result = array();
$Result['layout'] = false;
$Result['content'] = $form->render();
$Result['path'] = array( array( 'url' => '/owmoduleformssamples/register/', 'text' =>  $title) );

?>