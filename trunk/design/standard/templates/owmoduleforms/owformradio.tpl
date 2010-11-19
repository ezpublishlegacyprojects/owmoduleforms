{def $current_id=''}
<div class="ow_radio">
    {foreach $element.options.values as $value => $radio_label}
        {set $current_id=concat($element.options.name, '_', $value)}
        <div class="ow_radio_item">
            <input type="radio" name="{$element.options.name}" value="{$value}" id="{$current_id}" {if eq($value, $element.value)}checked="checked"{/if} {foreach $element.available_html_attributes as $attribute}{if is_set($element.options.$attribute)} {$attribute}="{$element.options.$attribute}"{/if}{/foreach} />
            <label for="{$current_id}">{$radio_label}</label>
        </div>
    {/foreach}
</div>