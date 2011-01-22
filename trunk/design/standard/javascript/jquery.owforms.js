function update_error_data(error_text, input_id)
{
	ok_display = 'none';
	ko_display = 'block';
	if (!error_text)
	{
		error_text = '';
		ok_display = 'block';
		ko_display = 'none';
	}
	jQuery('#'+input_id+'_error .owmoduleforms-error-text').html(error_text);
	jQuery('#'+input_id+'_icon_ok').css('display', ok_display);
	jQuery('#'+input_id+'_icon_ko').css('display', ko_display);
}

function call_ajax_validation(post_data, input_id)
{
	$.ez( 'ezjscowforms::validate', post_data, function( data )  
	{
		var validation_response = ( data.error_text ) ? data.error_text : data.content;
		if (validation_response)
		{
			update_error_data(validation_response, input_id);
		}
	});
}

function validate_input(is_required, input_id, post_data, fields, type)
{
	if (type == 'container')
	{
		input_selector = '';
		for(var i=0; i < fields.length; i++)
		{
			input_selector+=' #' + fields[i];
			if ((i+1) < fields.length)
			{
				input_selector+=',';
			}
		}
	}
	else
	{
		input_selector = '#' + input_id;
	}
	
	jQuery(input_selector).change(function()
	{
		var input_value = $('#'+input_id).val();
		if (is_required && '' == input_value)
    	{
    		update_error_data('is_required', input_id);
    	}
    	else
    	{
    		var is_valid = true;
    		for (var i=0; i < post_data.length; i++)
    		{
	        	if (type == 'element')
				{
	        		post_data[i]['value'] = input_value;
	    		}
	    		else
	    		{
	    			var children_values = {};
	        		for(var j=0; j < fields.length; j++)
		        	{
		        		var child_id = fields[j];
		        		var child_value = $('#'+child_id).val();
		        		post_data[i][child_id] = child_value;
		        		children_values[child_id] = child_value;
					}
					post_data[i]['value'] = children_values;
	    		}
	        	call_ajax_validation(post_data[i], input_id);
    		}
    		if (is_valid)
    		{
    			update_error_data('', input_id);
    		}
		}
	});
}