{def $current_id=''}
	<div class="ow_input_group">
	    {foreach $element.options.values as $value => $checkbox_label}
	        {set $current_id=concat($element.options.name, '_', $value)}
	        <div class="ow_input_item">
	            <input type="checkbox" name="{$element.options.name}[]" value="{$value}" id="{$current_id}" {if $element.value|contains($value)}checked="checked"{/if}{foreach $element.available_html_attributes as $attribute}{if is_set($element.options.$attribute)} {$attribute}="{$element.options.$attribute}"{/if}{/foreach} />
	            <label for="{$current_id}">{$checkbox_label}</label>
	        </div>
	    {/foreach}
	</div>
{undef $current_id}