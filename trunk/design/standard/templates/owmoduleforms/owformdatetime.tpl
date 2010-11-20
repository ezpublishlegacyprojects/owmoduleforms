{def $base = ezini('eZJSCore', 'LocalScriptBasePath', 'ezjscore.ini')}
	{ezscript_require( 'ezjsc::yui2' )}
	{ezcss_require( concat( '/', $base.yui2, 'calendar/assets/calendar.css' ) )}
{undef $base}
	
<script type="text/javascript">
	(function() {ldelim}
	    YUILoader.addModule({ldelim}
	        name: 'datepicker',
	        type: 'js',
	        fullpath: '{"javascript/ezdatepicker.js"|ezdesign( 'no' )}',
	        requires: ["calendar"],
	        after: ["calendar"],
	        skinnable: false
	    {rdelim});
	
	    YUILoader.require(["datepicker"]);
	
	    // Load the files using the insert() method.
	    var options = [];
	    YUILoader.insert(options, "js");
	{rdelim})();
</script>

{def $datetime=$element}
	<fieldset {foreach $element.available_html_attributes as $attribute}{if is_set($element.options.$attribute)} {$attribute}="{$element.options.$attribute}"{/if}{/foreach}>
		{if is_set($datetime.options.legend)}
			<legend>{$datetime.options.legend}</legend>
		{/if}
		<div class="date">
			{include uri='design:owmoduleforms/owforminput.tpl' element=$datetime.form_elements.0}
			{include uri='design:owmoduleforms/owforminput.tpl' element=$datetime.form_elements.1}
			{include uri='design:owmoduleforms/owforminput.tpl' element=$datetime.form_elements.2}
		</div>
		<img
			class="datepicker-icon"
			src={"calendar_icon.png"|ezimage}
			id="_datetime_cal_{$datetime.options.id}"
			width="24" height="28"
			onclick="showDatePicker( '', '{$datetime.options.id}', 'datetime' );" style="cursor: pointer;"
		/>
		<div
			id="_datetime_cal_container_{$datetime.options.id}"
			style="display: none; position: absolute;">
		</div>
		<div class="time">
			{include uri='design:owmoduleforms/owforminput.tpl' element=$datetime.form_elements.3}
			{include uri='design:owmoduleforms/owforminput.tpl' element=$datetime.form_elements.4}
		</div>
		{foreach $datetime.errors as $error}
	        <span class="warning">{$error}</span><br/>
	    {/foreach}
	</fieldset>
{undef $datetime}