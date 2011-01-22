<div class="border-box">
    <div class="border-tl">
        <div class="border-tr">
            <div class="border-tc"></div>
        </div>
    </div>
    <div class="border-ml">
        <div class="border-mr">
            <div class="border-mc float-break">
                <div class="owmoduleforms feedback">
                	<div class="attribute-header">
						<h1 class="long">{$confirm_message}</h1>
					</div>
					<div class="feedback">
                    	<h2>Your submitted data:</h2>
					</div>
                    <ul>
                        {foreach $submitted_data as $data}
                            <li>
                            	<strong>{$data.label}:</strong>
	                            {if eq('owFormFile', $data.type)}
	                                 <img src={$data.value.upload_file_path|ezroot()} />
	                            {else}
	                                <span>{$data.value}</span>
	                            {/if}
                            </li>
                        {/foreach}
                    </ul>
				</div>
            </div>
        </div>
    </div>
    <div class="border-bl">
        <div class="border-br">
            <div class="border-bc"></div>
        </div>
    </div>
</div>