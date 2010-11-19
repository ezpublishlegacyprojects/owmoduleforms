{def $is_selected=cond($is_multiple,$select.value|contains($option_value),eq($select.value, $option_value))}
    <option value="{$option_value}" {if $is_selected}selected="selected"{/if}>{$option_label}</option>
{undef $is_selected}