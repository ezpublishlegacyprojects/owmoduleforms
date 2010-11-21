{if is_set($element.options.maxfilesize)}
	<input type="hidden" name="MAX_FILE_SIZE" value="{$element.options.maxfilesize}" />
{/if}	
<input type="file" {foreach $element.available_html_attributes as $attribute}{if is_set($element.options.$attribute)} {$attribute}="{$element.options.$attribute}"{/if}{/foreach} />