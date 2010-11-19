{if is_set($form.options.title)}
	<div class="maincontentheader">
		<h1>{$form.options.title|i18n("design/owmoduleforms")}</h1>
	</div>
{/if}
<div class="owmoduleforms">
	<form {foreach $form.available_html_attributes as $attribute}{if is_set($form.options.$attribute)} {$attribute}="{$form.options.$attribute}"{/if}{/foreach}>
		{include uri='design:owmoduleforms/formelements.tpl' form_elements=$form.form_elements}
	</form>
</div>