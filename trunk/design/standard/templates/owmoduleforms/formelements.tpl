{foreach $form_elements as $element}
	{if eq('owformcontainer', get_class($element))}
		{include uri='design:owmoduleforms/formcontainer.tpl' element=$element}
	{elseif eq('owformfieldset', get_class($element))}
		{include uri='design:owmoduleforms/formfieldset.tpl' element=$element}
	{elseif eq('owformmarkup', get_class($element))}
		{include uri='design:owmoduleforms/formmarkup.tpl' element=$element}
	{elseif $input_types|contains(get_class($element))}
		{include uri='design:owmoduleforms/forminput.tpl' element=$element}
	{else}
		<p>error : unknown form type!</p>
	{/if}
{/foreach}