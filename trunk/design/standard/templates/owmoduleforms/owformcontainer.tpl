{def $children = $element.form_elements}
	<div {foreach $element.available_html_attributes as $attribute}{if is_set($element.options.$attribute)} {$attribute}="{$element.options.$attribute}"{/if}{/foreach}>
		{include uri='design:owmoduleforms/form_elements.tpl' form_elements=$children}
		{include uri='design:owmoduleforms/form_errors.tpl' errors=$element.errors}
	</div>
{undef $children }