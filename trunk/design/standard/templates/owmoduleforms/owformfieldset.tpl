<fieldset>
	{if is_set($element.options.legend)}
		<legend>{$element.options.legend}</legend>
	{/if}
	{include uri='design:owmoduleforms/formelements.tpl' form_elements=$element.form_elements}
</fieldset>