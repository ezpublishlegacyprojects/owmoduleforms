{def
    $is_multiple=eq('multiple', $element.options.multiple)
    $select_name=cond($is_multiple, concat($element.options.name, '[]'), $element.options.name)
}
	<select name="{$select_name}"{foreach $element.available_html_attributes as $attribute}{if is_set($element.options.$attribute)} {$attribute}="{$element.options.$attribute}"{/if}{/foreach}>
	    {foreach $element.options.values as $value => $option}
	        {if is_array($option)}
	            {include uri='design:owmoduleforms/owformoptgroup.tpl' optgroup_label=$value options=$option select=$element is_multiple=$is_multiple}
	        {else}
	            {include uri='design:owmoduleforms/owformoption.tpl' option_value=$value option_label=$option select=$element is_multiple=$is_multiple}
	        {/if}
	    {/foreach}
	</select>
{undef $is_multiple $select_name}