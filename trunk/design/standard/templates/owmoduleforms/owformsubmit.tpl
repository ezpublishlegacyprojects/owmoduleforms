<input class="button" type="submit" value="{$element.options.name}" {foreach $element.available_html_attributes as $attribute}{if is_set($element.options.$attribute)} {$attribute}="{$element.options.$attribute}"{/if}{/foreach} />