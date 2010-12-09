{def $js_library=ezini('eZJSCore', 'PreferredLibrary', 'ezjscore.ini')}
	{if eq($js_library, 'yui3')}
		{ezscript_require(array('ezjsc::yui3', 'ezjsc::yui3io'))}
		<script type="text/javascript" src={'javascript/yui3.owforms.js'|ezdesign()} charset="utf-8"></script>
	{elseif eq($js_library, 'jquery')}
		{ezscript_require( array('ezjsc::jquery', 'ezjsc::jqueryio'))}
		<script type="text/javascript" src={'javascript/jquery.owforms.js'|ezdesign()} charset="utf-8"></script>
	{/if}
{undef $js_library}

{if is_set($form.options.title)}
	<div class="attribute-header">
		<h1 class="long">{$form.options.title|i18n("design/owmoduleforms")}</h1>
	</div>
{/if}
<div class="owmoduleforms">
	<form {foreach $form.available_html_attributes as $attribute}{if is_set($form.options.$attribute)} {$attribute}="{$form.options.$attribute}"{/if}{/foreach}>
		{include uri='design:owmoduleforms/form_elements.tpl' form_elements=$form.form_elements}
		{include uri='design:owmoduleforms/form_errors.tpl' errors=$form.errors id=$form.options.id input=$form type='container'}
	</form>
</div>