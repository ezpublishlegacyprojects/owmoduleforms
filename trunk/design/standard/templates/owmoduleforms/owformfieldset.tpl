{def $fieldset=$element}
	<fieldset {foreach $element.available_html_attributes as $attribute}{if is_set($element.options.$attribute)} {$attribute}="{$element.options.$attribute}"{/if}{/foreach}>
		{if is_set($fieldset.options.legend)}
			<legend>{$fieldset.options.legend}</legend>
		{/if}
		{include uri='design:owmoduleforms/formelements.tpl' form_elements=$fieldset.form_elements}
		{foreach $fieldset.errors as $error}
	        <span class="warning">{$error}</span><br/>
	    {/foreach}
	</fieldset>
{undef $fieldset}