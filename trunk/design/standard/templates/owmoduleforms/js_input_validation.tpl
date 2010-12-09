{def
	$params='['
	$fields=array()
	$required = cond($input.options.required, 'true', 'false')
	$validation_counter=1
}
	{if is_set($input.options.validation)}
		{foreach $input.options.validation as $validator_name => $validation_params}
			{if ne($validation_counter, 1)}
				{set $params = concat($params, ',')}
			{/if}
			{set $params = concat($params, "{validator:'", $validator_name, "'")}
			{if is_array($validation_params)}
				{foreach $validation_params as $param_name => $param_value}
					{if eq($param_value, 'child')}
						{set $fields=$fields|append(concat("'", $param_name,"'"))}
					{else}
						{set $params = concat($params, ',', $param_name, ":'", $param_value, "'")}
					{/if}
				{/foreach}
			{/if}
			{set $params=concat($params, '\}')}
			{set $validation_counter=$validation_counter|inc()}
		{/foreach}
	{/if}
	{set $params=concat($params, ']')}
	{set $fields=concat('[', $fields|implode(','), ']')}
	<script type="text/javascript">validate_input({$required}, '{$input.options.id}', {$params}, {$fields}, '{$type}');</script>
{undef $params $required $fields}