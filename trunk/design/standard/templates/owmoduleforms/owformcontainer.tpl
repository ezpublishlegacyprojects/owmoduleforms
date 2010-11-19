{def $children = $element.form_elements}
	<div {foreach $element.available_html_attributes as $attribute}{if is_set($element.options.$attribute)} {$attribute}="{$element.options.$attribute}"{/if}{/foreach}>
		{include uri='design:owmoduleforms/formelements.tpl' form_elements=$children}
	</div>
{undef $children }