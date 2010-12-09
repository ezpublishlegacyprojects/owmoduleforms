function update_error_data(error_text, input_id)
{
	YUI( YUI3_config ).use('node', 'io-ez', function( Y )
	{
		ok_display = 'none';
		ko_display = 'block';
		if (!error_text)
		{
			error_text = '';
			ok_display = 'block';
			ko_display = 'none';
		}
		Y.get('#'+input_id+'_error .owmoduleforms-error-text').set('innerHTML', error_text);
		Y.get('#'+input_id+'_icon_ok').setStyle('display', ok_display);
		Y.get('#'+input_id+'_icon_ko').setStyle('display', ko_display);
	});
}
			
function validate_input(is_required, input_id, post_data, fields, type)
{
	YUI( YUI3_config ).use('node', 'io-ez', function( Y )
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
	
		Y.on( "change", function( e )
		{
			var input_value = Y.get('#'+input_id).get('value');
			var params = '';
			if (is_required && '' == input_value)
	    	{
	    		update_error_data('is_required', input_id);
	    	}
	    	else
	    	{
	        	if (type == 'element')
				{
	    			post_data['value']=input_value;
	    		}
	    		else
	    		{
	        		for(var i=0; i < fields.length; i++)
		        	{
		        		post_data[fields[i]] = Y.get('#'+fields[i]).get('value');
		        		post_data['value['+fields[i]+']'] = Y.get('#'+fields[i]).get('value');
					}
	    		}
			    
	        	for(param in post_data)
	        	{
	        		params += param + '=' + post_data[param] + '&';
	        	}
	        	
			    Y.io.ez( 'ezjscowforms::validate', {
		            data: params,
		            on:
		            {
		            	success: function( id,r )
		            	{
		                	var json = r.responseJSON;
			                var validation_response = ( json.error_text ) ? json.error_text : json.content;
			                update_error_data(validation_response, input_id);
		                }
		            }
		        });
	    	}
		}, input_selector );
	});
}