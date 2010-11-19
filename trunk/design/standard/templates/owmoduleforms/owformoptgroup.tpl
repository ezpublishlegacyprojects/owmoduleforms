<optgroup label="{$optgroup_label}">
    {foreach $options as $value => $label}
        {include uri='design:owmoduleforms/owformoption.tpl' option_value=$value option_label=$label select=$select is_multiple=$is_multiple}
    {/foreach}
</optgroup>