{foreach $form_elements as $element}
	{if $element.type|eq('container')}
		{include uri='design:owmoduleforms/owformcontainer.tpl' element=$element}
	{elseif $element.type|eq('fieldset')}
		{include uri='design:owmoduleforms/owformfieldset.tpl' element=$element}
	{elseif $element.type|eq('datetime')}
		{include uri='design:owmoduleforms/owformdatetime.tpl' element=$element}
	{elseif $element.type|eq('markup')}
		{include uri='design:owmoduleforms/owformmarkup.tpl' element=$element}
    {elseif $element.type|eq('hidden')}
		{include uri='design:owmoduleforms/owformhidden.tpl' element=$element}
    {elseif $element.type|eq('submit')}
        {include uri='design:owmoduleforms/owformsubmit.tpl' element=$element}
    {elseif $element.type|eq('button')}
        {include uri='design:owmoduleforms/owforminputbutton.tpl' element=$element}
    {elseif $element.type|eq('image')}
        {include uri='design:owmoduleforms/owformimage.tpl' element=$element}
    {else}
		{include uri='design:owmoduleforms/owforminput.tpl' element=$element}
	{/if}
{/foreach}