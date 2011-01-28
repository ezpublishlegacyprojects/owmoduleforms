<?php

$title = ezi18n( 'extension/owmoduleforms', 'Sample Calculator' );
$form = new owCalculatorForm(
    array(
    	'name' => 'calculator',
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
		'url' => '/owmoduleformssamples/calculator/',
		'text' =>  $title
	)
);

?>