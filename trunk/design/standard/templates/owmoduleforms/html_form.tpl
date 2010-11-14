{def $input_types=array('owformtext', 'owformsubmit', 'owformbutton', 'owformradio', 'owformselect')}
	{if $form_title}
		<div class="maincontentheader">
			<h1>{$form_title|i18n("design/owmoduleforms")}</h1>
		</div>
	{/if}
	<form method="{$form_method}" name="{$form_name}">
		{include uri='design:owmoduleforms/formelements.tpl' form_elements=$form_elements}
	</form>
{undef $input_types}