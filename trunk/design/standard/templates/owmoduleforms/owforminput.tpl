<div class="block float-break">
    <div class="element">
    	{if $element.options.label}
        	<label {if is_set($element.options.id)}for="{$element.options.id}"{/if}>
	        	{$element.options.label}:
	        	{if $element.options.required}
	        		<strong class="required">*</strong>
				{/if}
			</label>
        {/if}
        {include uri=concat('design:owmoduleforms/', get_class($element), '.tpl') element=$element}
		{foreach $element.errors as $error}
			<span class="warning">{$error}</span><br/>
		{/foreach}
    </div>
</div>