{def $fieldset=$element}
	<fieldset {foreach $element.available_html_attributes as $attribute}{if is_set($element.options.$attribute)} {$attribute}="{$element.options.$attribute}"{/if}{/foreach}>
		{if is_set($fieldset.options.legend)}
			<legend>{$fieldset.options.legend}</legend>
		{/if}
		{include uri='design:owmoduleforms/form_elements.tpl' form_elements=$fieldset.form_elements}
		{include uri='design:owmoduleforms/form_errors.tpl' errors=$fieldset.errors id=$fieldset.options.id input=$fieldset type='container'}
	</fieldset>
{undef $fieldset}