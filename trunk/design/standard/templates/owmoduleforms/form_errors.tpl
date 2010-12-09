{def $js_library = ezini('eZJSCore', 'PreferredLibrary', 'ezjscore.ini')}
	{if or(is_set($input.options.validation), $input.options.required)}
		<div id="{concat($id, '_error')}" class="owmoduleforms-error">
			<div class="owmoduleforms-error-icon">
				<img id="{concat($id, '_icon_ko')}" src={'images/cross.png'|ezdesign()}{if $errors.0} style="display:block;"{/if} />
				<img id="{concat($id, '_icon_ok')}" src={'images/tick.png'|ezdesign()} />
			</div>
			<div class="owmoduleforms-error-text">
				{foreach $errors as $error}
					{if is_array($error)|not()}
						{$error}
					{/if}
				{/foreach}
			</div>
		</div>
		{include uri='design:owmoduleforms/js_input_validation.tpl' input=$input type=$type}
	{/if}
{undef $js_library}