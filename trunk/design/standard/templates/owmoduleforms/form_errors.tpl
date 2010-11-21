{foreach $errors as $error}
	{if is_array($error)|not()}
		<span class="warning">{$error}</span>
	{/if}
{/foreach}