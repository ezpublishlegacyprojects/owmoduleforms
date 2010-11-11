<fieldset>
	{if is_set($element.legend)}
		<legend>{$element.legend}</legend>
	{/if}
	{include uri='design:owmoduleforms/formelements.tpl' form_elements=$element.form_elements}
</fieldset>