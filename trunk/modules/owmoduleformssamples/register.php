<?php

$title = ezi18n( 'extension/owmoduleforms', 'Register user form' );
$form = new owRegisterForm(
    array(
        'name' => 'register',
        'method' => 'post',
        'title' => $title,
        'module' => $Module
    )
);
$Module->setTitle($title);

$Result = array();
$Result['layout'] = false;
$Result['content'] = $form->render();
$Result['path'] = array(
	array(
		'url' => '/owmoduleformssamples/register/',
		'text' =>  $title
	)
);

?>