{def $children = $element.form_elements}
	<div class="$element.css_class">
		{include uri='design:owmoduleforms/formelements.tpl' form_elements=$children}
	</div>
{undef $children }