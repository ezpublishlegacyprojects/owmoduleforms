{foreach $form_elements as $element}
	{switch match=get_class($element)}
		{case match='owformcontainer'}
			{include uri='design:owmoduleforms/formcontainer.tpl' element=$element}
		{/case}
		{case match='owformtext'}
			{include uri='design:owmoduleforms/formtext.tpl' element=$element}
		{/case}
		{case match='owformsubmit'}
			{include uri='design:owmoduleforms/formsubmit.tpl' element=$element}
		{/case}
		{case match='owformfieldset'}
			{include uri='design:owmoduleforms/formfieldset.tpl' element=$element}
		{/case}
	{/switch}
{/foreach}