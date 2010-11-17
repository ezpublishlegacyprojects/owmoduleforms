{def
    $input_types=array(
        'owformtext', 'owformpassword', 'owformsubmit',
        'owformbutton', 'owformradio', 'owformselect',
        'owformcheckbox', 'owformtextarea', 'owformfile',
        'owformhidden', 'owformbutton', 'owformimage',
        'owformreset'
    )
}
	{if is_set($form_options.title)}
		<div class="maincontentheader">
			<h1>{$form_options.title|i18n("design/owmoduleforms")}</h1>
		</div>
	{/if}
	<div class="owmoduleforms">
		<form method="{$form_options.method}" name="{$form_options.name}">
			{include uri='design:owmoduleforms/formelements.tpl' form_elements=$form_elements}
		</form>
	</div>
{undef $input_types}