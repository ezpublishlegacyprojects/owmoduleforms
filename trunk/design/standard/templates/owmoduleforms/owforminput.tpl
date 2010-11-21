{def $type=get_class($element)}
	<div class="block float-break">
	    <div class="element">
	    	{if and($element.options.label, array('owformsubmit', 'owformimage', 'owformbutton', 'owforminputbutton')|contains($type)|not())}
		    	<label {if is_set($element.options.id)}for="{$element.options.id}"{/if}>
		        	{$element.options.label}:
		        	{if $element.options.required}
		        		<strong class="required">*</strong>
					{/if}
				</label>
	    	{/if}
		    {include uri=concat('design:owmoduleforms/', $type, '.tpl') element=$element}
		    {include uri='design:owmoduleforms/form_errors.tpl' errors=$element.errors}
	    </div>
	</div>
{undef $type}