<div class="block float-break">
    <div class="element">
    	{if $element.label}
        	<label>
	        	{$element.label}:
	        	{if $element.attributes.required}
	        		<strong class="required">*</strong>
				{/if}
			</label>
        {/if}
        {switch match=get_class($element)}
			{case match='owformtext'}
				{include uri='design:owmoduleforms/formtext.tpl' element=$element}
			{/case}
			{case match='owformsubmit'}
				{include uri='design:owmoduleforms/formsubmit.tpl' element=$element}
			{/case}
		{/switch}
		{foreach $element.errors as $error}
			<span class="warning">{$error}</span><br/>
		{/foreach}
    </div>
</div>