{foreach $form_elements as $element}
	{if eq('owformcontainer', get_class($element))}
		{include uri='design:owmoduleforms/owformcontainer.tpl' element=$element}
	{elseif eq('owformfieldset', get_class($element))}
		{include uri='design:owmoduleforms/owformfieldset.tpl' element=$element}
	{elseif eq('owformdatetime', get_class($element))}
		{include uri='design:owmoduleforms/owformdatetime.tpl' element=$element}
	{elseif eq('owformmarkup', get_class($element))}
		{include uri='design:owmoduleforms/owformmarkup.tpl' element=$element}
    {elseif array('owformsubmit', 'owformcancel')|contains(get_class($element))}
        {include uri='design:owmoduleforms/owformsubmit.tpl' element=$element}
    {elseif eq('owforminputbutton', get_class($element))}
        {include uri='design:owmoduleforms/owforminputbutton.tpl' element=$element}
    {elseif eq('owformimage', get_class($element))}
        {include uri='design:owmoduleforms/owformimage.tpl' element=$element}
    {else}
		{include uri='design:owmoduleforms/owforminput.tpl' element=$element}
	{/if}
{/foreach}